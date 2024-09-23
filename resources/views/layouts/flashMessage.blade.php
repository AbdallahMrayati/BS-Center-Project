<style>
    @import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap");

    :root {
        --bg-clr: #ef4d61;
        --white: #fff;
        --text-primary-clr: #282c36;
        --text-secondary-clr: #a9abaf;
        --first-clr: #007bc2;
        --second-clr: #f0a92e;
        --third-clr: #21a67a;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Open Sans", sans-serif;
    }

    body {
        background: var(--bg-clr);
        font-size: 12px;
    }

    .wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 0 10px;
    }

    .alert_wrapper .alert_item {
        background: var(--white);
        margin-bottom: 25px;
        padding: 20px 25px;
        border-radius: 3px;
        display: flex;
        align-items: center;
        box-shadow: 0 0 2px rgba(0, 0, 0, 0.15);
    }

    .alert_wrapper .alert_item .text {
        padding: 0 20px;
        width: calc(100% - 80px);
    }

    .alert_wrapper .alert_item .text h3 {
        font-size: 16px;
        margin-bottom: 5px;
        color: var(--text-primary-clr);
    }

    .alert_wrapper .alert_item .text p {
        color: var(--text-secondary-clr);
    }

    .alert_wrapper .alert_item .icon,
    .alert_wrapper .alert_item .close {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }

    .alert_wrapper .alert_item .icon ion-icon {
        color: var(--white);
        font-size: 20px;
    }

    .alert_wrapper .alert_item.first_item .icon {
        background: var(--first-clr);
    }

    .alert_wrapper .alert_item.second_item .icon {
        background: var(--second-clr);
    }

    .alert_wrapper .alert_item.third_item .icon {
        background: var(--third-clr);
    }

    .alert_wrapper .alert_item .close {
        font-size: 25px;
        color: var(--text-secondary-clr);
    }

    .alert_wrapper .alert_item .close ion-icon {
        cursor: pointer;
        transition: all 0.5s ease;
    }

    .alert_wrapper .alert_item.first_item .close ion-icon:hover {
        color: var(--first-clr);
    }

    .alert_wrapper .alert_item.second_item .close ion-icon:hover {
        color: var(--second-clr);
    }

    .alert_wrapper .alert_item.third_item .close ion-icon:hover {
        color: var(--third-clr);
    }
</style>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>

<div class="wrapper">
    <div class="alert_wrapper">

        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert_item third_item">
                <div class="icon">
                    <ion-icon name="checkmark"></ion-icon>
                </div>
                <div class="text">
                    <h3>Great success!</h3>
                    <p>{{ session('success') }}</p>
                </div>
                <div class="close">
                    <ion-icon name="close"></ion-icon>
                </div>
            </div>
        @endif

        {{-- Error Message --}}
        @if (session('error'))
            <div class="alert_item second_item">
                <div class="icon">
                    <ion-icon name="alert"></ion-icon>
                </div>
                <div class="text">
                    <h3>Yikes. Something went wrong.</h3>
                    <p>{{ session('error') }}</p>
                </div>
                <div class="close">
                    <ion-icon name="close"></ion-icon>
                </div>
            </div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="alert_item first_item">
                <div class="icon">
                    <ion-icon name="information"></ion-icon>
                </div>
                <div class="text">
                    <h3>Check your input.</h3>
                    <p>Please keep in mind to check your information before sending your request out.</p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="close">
                    <ion-icon name="close"></ion-icon>
                </div>
            </div>
        @endif

    </div>
</div>
