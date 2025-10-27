<?php

namespace App\Filament\Widgets;

use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;
use Saade\FilamentFullCalendar\Data\EventData;
use App\Models\Checkin;
use Filament\Actions\CreateAction;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;

class CheckinCalendarWidget extends FullCalendarWidget
{
    public Model | string | null $model = Checkin::class;
    // Lấy dữ liệu events từ DB (mỗi checkin/checkout là point event với start = time, end = null)
    public function fetchEvents(array $fetchInfo): array
    {
        return Checkin::query()
            ->where('time', '>=', $fetchInfo['start'])
            ->where('time', '<=', $fetchInfo['end'])
            ->with('employee') // Eager load để lấy tên employee
            ->get()
            ->map(function (Checkin $checkin) {
                return EventData::make()
                    ->id($checkin->id)
                    ->title($checkin->employee->name . ' - ' . ucfirst($checkin->type)) // Ví dụ: "John Doe - Check-in"
                    ->start($checkin->time)
                    ->end(null) // Point event
                    ->backgroundColor($checkin->type === 'checkin' ? 'green' : 'red') // Xanh cho check-in, đỏ cho check-out
                    ->allDay(false) // Không phải all-day event
                    ->toArray();
            })
            ->toArray();
    }

    // Định nghĩa form schema cho create/edit event (sử dụng getFormSchema thay vì form)

    public function getFormSchema(): array
    {
        return [
        ];
    }
    protected function headerActions(): array
    {
        return [
            CreateAction::make()
                ->label('New Checkin') // Nút bấm "New Checkin"
                ->requiresConfirmation() // Hiển thị modal confirm đơn giản chỉ có OK/Cancel
                ->modalHeading('Xác nhận Check-in/Check-out') // Tiêu đề modal
                ->modalDescription('Bạn có chắc muốn thực hiện check-in/check-out không?') // Mô tả trong modal
                ->modalSubmitActionLabel('OK') // Nút submit là "OK"
                ->action(function () {
                    $employeeId = auth()->user()->employee->id;
                    $now = now('Asia/Ho_Chi_Minh');

                    // Lấy bản ghi cuối cùng (bất kể ngày, chỉ cần trong vòng 12 tiếng gần nhất)
                    $lastCheck = Checkin::where('employee_id', $employeeId)
                        ->where('time', '>=', $now->copy()->subHours(12)) // Cho phép tính ca đêm
                        ->latest('time')
                        ->first();

                    // Nếu không có bản ghi trong 12h qua hoặc bản ghi cuối là checkout → checkin mới
                    $type = (!$lastCheck || $lastCheck->type === 'checkout') ? 'checkin' : 'checkout';

                    Checkin::create([
                        'employee_id' => $employeeId,
                        'type' => $type,
                        'time' => $now,
                    ]);

                    // Tùy chọn: Thêm notification
                    $this->dispatch('notify', [
                        'type' => 'success',
                        'message' => ucfirst($type) . ' thành công!',
                    ]);
                })
                ->successNotification(
                Notification::make()
                        ->success()
                        ->title('User registered')
                        ->body('The user has been created successfully.'),
                )
                ->failureNotification(
                    Notification::make()
                        ->danger()
                        ->title('User registration failed')
                        ->body('The user could not be created.'),
                )
                ,
        ];
    }
    // Infolist cho view action (tùy chọn, hiển thị chi tiết khi click event)
    // public function infolist(Infolist $infolist): Infolist
    // {
    //     return $infolist
    //         ->schema([
    //             // Có thể thêm TextEntry::make('employee.name'), TextEntry::make('type'), v.v. nếu cần
    //         ]);
    // }

    // Cấu hình FullCalendar
    public function config(): array
    {
        return [
            'initialView' => 'dayGridMonth', // View tuần với giờ
            'headerToolbar' => [
                'left' => 'prev,next today',
                'center' => 'title',
                'right' => '',
            ],
            'slotMinTime' => '08:00:00', // Giờ bắt đầu
            'slotMaxTime' => '18:00:00', // Giờ kết thúc
            'editable' => true, // Cho phép kéo thả (cập nhật time)
            'selectable' => false, // Chọn thời gian để tạo mới
            'eventDurationEditable' => false, // Không cho resize vì point event
        ];
    }
}