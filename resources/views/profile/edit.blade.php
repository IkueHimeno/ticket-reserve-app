<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 1.5rem; letter-spacing: 0.3em; color: var(--color-primary); margin: 0; text-shadow: 0 0 10px var(--color-primary);">
            PROFILE SETTINGS
        </h2>
    </x-slot>

    <div style="padding: 40px 0; background-image: radial-gradient(circle at 50% 0%, #0f1b3d 0%, #000000 70%); min-height: 100vh;">
        <div style="max-width: 800px; margin: 0 auto; padding: 0 20px; display: flex; flex-direction: column; gap: 30px;">
            
            <div style="background: rgba(15, 27, 61, 0.7); border: 1px solid var(--color-primary); border-radius: 15px; padding: 30px; box-shadow: 0 0 20px rgba(79, 163, 255, 0.1); backdrop-filter: blur(10px);">
                <div style="max-width: 100%;">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div style="background: rgba(15, 27, 61, 0.7); border: 1px solid var(--color-primary); border-radius: 15px; padding: 30px; box-shadow: 0 0 20px rgba(79, 163, 255, 0.1); backdrop-filter: blur(10px);">
                <div style="max-width: 100%;">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div style="background: rgba(255, 79, 79, 0.05); border: 1px solid #ff4f4f; border-radius: 15px; padding: 30px; box-shadow: 0 0 20px rgba(255, 79, 79, 0.1);">
                <div style="max-width: 100%;">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>

    <style>
        input {
            background-color: rgba(0, 0, 0, 0.5) !important;
            border: 1px solid var(--color-primary) !important;
            color: white !important;
            border-radius: 5px !important;
        }
        label {
            color: var(--color-accent) !important;
            letter-spacing: 0.1em;
        }
        p {
            color: #bbb !important;
        }
        button[type="submit"] {
            background-color: var(--color-secondary) !important;
            color: white !important;
            padding: 10px 20px !important;
            border-radius: 5px !important;
            font-weight: bold !important;
            cursor: pointer !important;
            border: none !important;
            transition: 0.3s !important;
        }
        button[type="submit"]:hover {
            filter: brightness(1.2);
            box-shadow: 0 0 15px var(--color-secondary);
        }
    </style>
</x-app-layout>
