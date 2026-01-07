<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 1.25rem; font-weight: 600; color: #1f2937;">
            マイページ - 予約済みチケット一覧
        </h2>
    </x-slot>

    <div style="padding: 2rem 0; background-color: #f3f4f6;">
        <div style="max-width: 900px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); padding: 40px;">
            
            @if(session('success'))
                <div style="background-color: #d1e7dd; color: #0f5132; padding: 15px; margin-bottom: 20px; border-radius: 4px;">
                    {{ session('success') }}
                </div>
            @endif

            @if($reservations->isEmpty())
                <p style="text-align: center; color: #6b7280;">現在、予約しているチケットはありません。</p>
            @else
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="border-bottom: 2px solid #e5e7eb; text-align: left;">
                            <th style="padding: 12px;">公演名 / 日時</th>
                            <th style="padding: 12px;">座席</th>
                            <th style="padding: 12px;">予約日</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservations as $reservation)
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <td style="padding: 16px 12px;">
                                    <div style="font-weight: bold; color: #1f2937;">
                                        {{ $reservation->performanceSchedule->performance->title }}
                                    </div>
                                    <div style="font-size: 0.875rem; color: #6b7280;">
                                        {{ \Carbon\Carbon::parse($reservation->performanceSchedule->start_time)->format('Y年m月d日 H:i') }}
                                    </div>
                                </td>
                                <td style="padding: 16px 12px; font-weight: 500;">
                                    {{ $reservation->seat->row_name }} - {{ $reservation->seat->seat_number }}
                                </td>
                                <td style="padding: 16px 12px; font-size: 0.875rem; color: #9ca3af;">
                                    {{ $reservation->created_at->format('Y/m/d') }}
                                </td>
                                <td style="padding: 16px 12px;">
                                    <form action="{{ route('reservations.destroy', $reservation) }}" method="POST" onsubmit="return confirm('本当にこの予約をキャンセルしてもよろしいですか？');">
                                        @csrf
                                        @method('DELETE') <button type="submit" 
                                                                  style="color: #ef4444; background: none; border: 1px solid #ef4444; 
                                                                         padding: 4px 6px; border-radius: 4px; cursor: pointer; font-size: 0.8rem; transition: 0.3s" 
                                                                  onmouseover="this.style.backgroundColor='#fee2e2'" 
                                                                  onmouseout="this.style.backgroundColor='transparent'">
                                                            キャンセル</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-app-layout>