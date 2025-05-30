<!DOCTYPE html>
<html lang="en">
@include('client.layouts.head')

<body class="bg-blue-50">
    @if (session('message'))
        <div id="message-box"
            class="fixed top-0 left-1/2 translate-x-[-50%] transition-all shadow-2xl translate-y-[-80px] mt-[80px] px-12 py-5 bg-red-100 rounded-xl border-2 border-red-500 text-red-500 z-50">
            <p class="flex gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <g fill="none">
                        <path
                            d="m12.594 23.258l-.012.002l-.071.035l-.02.004l-.014-.004l-.071-.036q-.016-.004-.024.006l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.016-.018m.264-.113l-.014.002l-.184.093l-.01.01l-.003.011l.018.43l.005.012l.008.008l.201.092q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.003-.011l.018-.43l-.003-.012l-.01-.01z" />
                        <path fill="currentColor"
                            d="M12 2a7 7 0 0 0-7 7v3.528a1 1 0 0 1-.105.447l-1.717 3.433A1.1 1.1 0 0 0 4.162 18h15.676a1.1 1.1 0 0 0 .984-1.592l-1.716-3.433a1 1 0 0 1-.106-.447V9a7 7 0 0 0-7-7m0 19a3 3 0 0 1-2.83-2h5.66A3 3 0 0 1 12 21" />
                    </g>
                </svg> {{ session('message') }}</p>
        </div>
    @endif

    <!-- Header -->
    @include('client.layouts.header')

    @yield('content')

    <!-- Footer -->
    @include('client.layouts.footer')

    <script>
        // Mobile menu toggle
        document.addEventListener("DOMContentLoaded", function() {
            const mobileMenuButton = document.querySelector(".md\\:hidden button");
            if (mobileMenuButton) {
                mobileMenuButton.addEventListener("click", function() {
                    // Toggle mobile menu here
                    alert("Menu di động sẽ hiển thị ở đây");
                });
            }
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const notDevElements = document.querySelectorAll(".not-dev");
            notDevElements.forEach(function(element) {
                //  element.style.display = "none";
                // get input, select, textarea and disable them
                const inputs = element.querySelectorAll("input, select, textarea, button");
                inputs.forEach(function(input) {
                    input.disabled = true;
                })
            });
        });
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>
    <script>
        tippy('[data-tippy-content]');
    </script>

    <div id="toast"
        class="fixed top-[50px] shadow-2xl right-0 translate-x-[100%] flex items-center duration-200 px-5 min-w-[200px] gap-5 h-[50px] z-[999] border-2 bg-red-100 text-red-500 border-red-400 rounded transition-all">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path fill="currentColor"
                d="M19.75 2A2.25 2.25 0 0 1 22 4.25v5.462a3.25 3.25 0 0 1-.952 2.298l-.026.026a6.5 6.5 0 0 0-9.028 8.92a3.256 3.256 0 0 1-4.043-.442L3.489 16.06a3.25 3.25 0 0 1-.004-4.596l8.5-8.51a3.25 3.25 0 0 1 2.3-.953zM17 5.502a1.5 1.5 0 1 0 0 3a1.5 1.5 0 0 0 0-3M23 17.5a5.5 5.5 0 1 1-11 0a5.5 5.5 0 0 1 11 0M17.5 14a.5.5 0 0 0-.5.5v4a.5.5 0 0 0 1 0v-4a.5.5 0 0 0-.5-.5m0 7.125a.625.625 0 1 0 0-1.25a.625.625 0 0 0 0 1.25" />
        </svg>
        <p class="m-auto" id="toast-label"></p>
    </div>
    <script>
        window.toast = document.getElementById('toast');
        window.toastLabel = document.getElementById('toast-label');
        window.toastOpen = () => {
            window.toast.style.transform = 'translateX(-10%)';
        }
        window.toastClose = () => {
            window.toast.style.transform = 'translateX(100%)';
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const messageBox = document.getElementById("message-box");
            if (messageBox) {
                setTimeout(function() {
                    messageBox.classList.remove("translate-y-[-80px]");
                    setTimeout(function() {
                        messageBox.classList.add("translate-y-[-80px]");
                    }, 3000);
                }, 50)
            }
        })
    </script>
    @stack('scripts')
</body>

</html>
