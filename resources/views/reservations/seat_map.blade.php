<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 1.5rem; letter-spacing: 0.3em; color: var(--color-primary); margin: 0; text-shadow: 0 0 10px var(--color-primary);">
            SELECT YOUR SEAT
        </h2>
    </x-slot>

    <div style="padding: 40px 0; background-image: radial-gradient(circle at 50% 0%, #0f1b3d 0%, #000000 70%); min-height: 100vh; color: var(--color-text);">
        
        <div style="max-width: 900px; margin: 0 auto; background: rgba(15, 27, 61, 0.7); border: 1px solid var(--color-primary); border-radius: 15px; padding: 40px; box-shadow: 0 0 20px rgba(79, 163, 255, 0.2); backdrop-filter: blur(10px);">

            <div style="text-align: center; margin-bottom: 40px; border-bottom: 1px solid rgba(79, 163, 255, 0.2); padding-bottom: 20px;">
                <h3 style="font-size: 1.4rem; color: var(--color-accent); margin-bottom: 10px;">
                    {{ $schedule->performance->title }}
                </h3>
                <p style="font-size: 1.1rem; letter-spacing: 0.1em;">
                    {{ \Carbon\Carbon::parse($schedule->start_time)->format('Y/m/d H:i') }} START
                </p>
            </div>

            <div style="display: flex; justify-content: center; margin-bottom: 50px;">
                <div style="width: 80%; background: linear-gradient(to bottom, #1a2a4a, #0c1024); border: 1px solid var(--color-primary); color: var(--color-primary); text-align: center; padding: 10px; border-radius: 4px; box-shadow: 0 0 15px rgba(79, 163, 255, 0.4);">
                    <span style="letter-spacing: 2em; font-size: 1.2rem; font-weight: bold; margin-left: 2em;">STAGE</span>
                </div>
            </div>

            <div style="overflow-x: auto; text-align: center;">
                <div style="display: inline-block; min-width: 600px;">
                    @php 
                        $groupedSeats = $seats->groupBy('row_name'); 
                    @endphp

                    @foreach($groupedSeats as $rowName => $rowSeats)
                        <div style="display: flex; align-items: center; justify-content: center; margin-bottom: 15px;">
                            <div style="width: 30px; color: var(--color-primary); font-weight: bold;">{{ $rowName }}</div>

                            <div style="display: flex; align-items: center; margin: 0 10px;">
                                @foreach($rowSeats as $index => $seat)
                                    @php
                                        $isReserved = in_array($seat->id, $reservedSeatIds);
                                        $isAlien = ($seat->rank === '宇宙人シート');
                                        $hasGap = ($index == 3); 
                                    @endphp

                                    <button type="button" 
                                        data-row-name="{{ $rowName }}"
                                        {{ $isReserved ? 'disabled' : '' }}
                                        style="
                                            width: 42px;
                                            height: 42px; 
                                            margin: 0 4px; 
                                            border-radius: 6px;
                                            font-size: 0.75rem;
                                            font-weight: bold;
                                            transition: 0.3s;
                                            cursor: {{ $isReserved ? 'not-allowed' : 'pointer' }};
                                            background-color: {{ $isReserved ? '#333' : ($isAlien ? 'rgba(0, 255, 127, 0.2)' : 'rgba(79, 163, 255, 0.1)') }};
                                            border: 1px solid {{ $isReserved ? '#555' : ($isAlien ? 'var(--color-accent)' : 'var(--color-primary)') }};
                                            color: {{ $isReserved ? '#777' : ($isAlien ? 'var(--color-accent)' : 'var(--color-primary)') }} !important;
                                            box-shadow: {{ $isReserved ? 'none' : '0 0 5px rgba(79, 163, 255, 0.2)' }};
                                        ">
                                        {{ $seat->seat_number }}
                                    </button>
                                    @if($hasGap) <div style="width: 40px;"></div> @endif
                                @endforeach
                            </div>
                            <div style="width: 30px; color: var(--color-primary); font-weight: bold;">{{ $rowName }}</div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div style="margin-top: 50px; padding-top: 30px; border-top: 1px solid rgba(255,255,255,0.1); display: flex; justify-content: center; gap: 30px; font-size: 0.875rem;">
                <div style="display: flex; align-items: center;"><span style="width: 15px; height: 15px; background: rgba(0, 255, 127, 0.2); border: 1px solid var(--color-accent); border-radius: 3px; margin-right: 8px;"></span> 宇宙人シート</div>
                <div style="display: flex; align-items: center;"><span style="width: 15px; height: 15px; background: rgba(79, 163, 255, 0.1); border: 1px solid var(--color-primary); border-radius: 3px; margin-right: 8px;"></span> 地球人シート</div>
                <div style="display: flex; align-items: center;"><span style="width: 15px; height: 15px; background: #333; border: 1px solid #555; border-radius: 3px; margin-right: 8px;"></span> 予約済み</div>
            </div>
        </div>

        <div style="margin-top: 40px; text-align:center;">
            <form id="reservation-form" action="{{ route('reservations.store') }}" method="POST">
                @csrf
                <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
                <input type="hidden" name="selected_seats" id="selected-seats-input">

                <button type="submit" style="background: linear-gradient(45deg, var(--color-primary), var(--color-secondary)); color: white !important; padding: 16px 80px; border-radius: 50px; font-weight: bold; cursor: pointer; border: none; font-size: 1.2rem; box-shadow: 0 0 20px rgba(123, 75, 255, 0.4); transition: 0.3s;" onmouseover="this.style.filter='brightness(1.2)'" onmouseout="this.style.filter='brightness(1.0)'">
                    予約に進む
                </a>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const maxSeats = 4;
            let selectedSeats = [];
            const seatButtons = document.querySelectorAll('button[type="button"]:not(:disabled)');

            seatButtons.forEach(button => {
                button.dataset.originalBg = button.style.backgroundColor;
                button.dataset.originalBorder = button.style.border;
                button.dataset.originalColor = button.style.color;

                button.addEventListener('click', function(){
                    const rowName = this.dataset.rowName;
                    const seatNum = this.innerText.trim();
                    const seatId = rowName + ',' + seatNum;

                    if(selectedSeats.includes(seatId)) {
                        selectedSeats = selectedSeats.filter(id => id !== seatId);
                        this.style.setProperty('color', this.dataset.originalColor, 'important');
                        this.style.backgroundColor = this.dataset.originalBg;
                        this.style.border = this.dataset.originalBorder;
                        this.style.boxShadow = 'none';
                    } else {
                        if(selectedSeats.length >= maxSeats) {
                            alert('一度に予約できるのは４枚までです。');
                            return;
                        }
                        selectedSeats.push(seatId);
                        this.style.setProperty('color', '#ff4f4f', 'important');
                        this.style.backgroundColor = 'rgba(255, 79, 79, 0.4)';
                        this.style.border = '1px solid #ff4f4f';
                        this.style.boxShadow = '0 0 10px #ff4f4f';
                    }
                    document.getElementById('selected-seats-input').value = selectedSeats.join('|');
                });
            });
        });
    </script>
</x-app-layout>