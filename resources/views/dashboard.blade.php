<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 1.5rem; letter-spacing: 0.3em; color: var(--color-primary); margin: 0; text-shadow: 0 0 10px var(--color-primary);">
            MY RESERVATIONS
        </h2>
    </x-slot>

    <div style="padding: 40px 0; background-image: radial-gradient(circle at 50% 0%, #0f1b3d 0%, #000000 70%); min-height: 100vh;">
        <div style="max-width: 900px; margin: 0 auto; padding: 0 20px;">
            
            <div style="background: rgba(15, 27, 61, 0.7); border: 1px solid var(--color-primary); border-radius: 15px; padding: 40px; box-shadow: 0 0 20px rgba(79, 163, 255, 0.2); backdrop-filter: blur(10px);">
                
                <h3 style="font-size: 1.2rem; font-weight: bold; color: var(--color-accent); letter-spacing: 0.2em; margin-bottom: 30px; border-bottom: 1px solid rgba(0, 255, 127, 0.3); padding-bottom: 15px;">
                    現在の予約状況
                </h3>

                @if(isset($reservations) && $reservations->count() > 0)
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse; color: var(--color-text);">
                            <thead>
                                <tr style="border-bottom: 2px solid var(--color-primary);">
                                    <th style="padding: 15px; color: var(--color-primary); text-align: center;">公演日時</th>
                                    <th style="padding: 15px; color: var(--color-primary); text-align: center;">座席番号</th>
                                    <th style="padding: 15px; color: var(--color-primary); text-align: center;">ステータス</th>
                                    <th style="padding: 15px; color: var(--color-primary); text-align: center;">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reservations as $res)
                                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.1); transition: 0.3s;" onmouseover="this.style.backgroundColor='rgba(79, 163, 255, 0.05)'" onmouseout="this.style.backgroundColor='transparent'">
                                        
                                        <td style="padding: 15px; text-align: center;">
                                            {{ $res->performanceSchedule->start_time->format('Y/m/d H:i') }}
                                        </td>

                                        <td style="padding: 15px; text-align: center; vertical-align: middle;">
                                            <div style="display: inline-block; text-align: center;">
                                                <div style="font-weight: bold; font-size: 1.1rem;">
                                                    {{ $res->seat->row_name }}列{{ $res->seat->seat_number }}番
                                                </div>
                                                <div style="font-size: 0.7rem; margin-top: 2px; color: {{ $res->seat->rank === '宇宙人シート' ? 'var(--color-accent)' : 'var(--color-primary)' }}; opacity: 0.9;">
                                                    {{ $res->seat->rank }}
                                                </div>
                                            </div>
                                        </td>

                                        <td style="padding: 15px; text-align: center; color: var(--color-accent);">
                                            予約完了
                                        </td>

                                        <td style="padding: 15px; text-align: center;">
                                            <form action="{{ route('reservations.destroy', $res->id) }}" method="POST" onsubmit="return confirm('本当にキャンセルしますか？');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="background: none; border: 1px solid #ff4f4f; color: #ff4f4f !important; padding: 4px 12px; border-radius: 4px; font-size: 0.75rem; cursor: pointer; transition: 0.3s;" onmouseover="this.style.backgroundColor='rgba(255, 79, 79, 0.1)'" onmouseout="this.style.backgroundColor='transparent'">
                                                    キャンセル
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div>
                @else
                    <div style="text-align: center; padding: 50px 0;">
                        <p style="color: #888; margin-bottom: 30px; letter-spacing: 0.1em;">現在、有効な予約チケットはありません。</p>
                        <a href="/" class="btn-login" style="display: inline-block; padding: 12px 40px; background: linear-gradient(45deg, var(--color-primary), var(--color-secondary)); color: #ffffff !important; border-radius: 8px; text-decoration: none; font-weight: bold; box-shadow: 0 4px 15px rgba(123, 75, 255, 0.3);">
                            チケットを予約する
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
