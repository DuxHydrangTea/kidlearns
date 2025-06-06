<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng nhập - Tài liệu tiểu học</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              primary: {
                50: "#fdf2f8",
                100: "#fce7f3",
                200: "#fbcfe8",
                300: "#f9a8d4",
                400: "#f472b6",
                500: "#ec4899",
                600: "#db2777",
                700: "#be185d",
                800: "#9d174d",
                900: "#831843",
              },
              secondary: {
                50: "#fffbeb",
                100: "#fef3c7",
                200: "#fde68a",
                300: "#fcd34d",
                400: "#fbbf24",
                500: "#f59e0b",
                600: "#d97706",
                700: "#b45309",
                800: "#92400e",
                900: "#78350f",
              },
              accent: {
                50: "#ecfdf5",
                100: "#d1fae5",
                200: "#a7f3d0",
                300: "#6ee7b7",
                400: "#34d399",
                500: "#10b981",
                600: "#059669",
                700: "#047857",
                800: "#065f46",
                900: "#064e3b",
              },
            },
            borderRadius: {
              xl: "1rem",
              "2xl": "1.5rem",
              "3xl": "2rem",
            },
          },
        },
      };
    </script>
    <style type="text/css">
      @import url("https://fonts.googleapis.com/css2?family=Playwrite+US+Modern:wght@100..400&display=swap");
      body {
        font-family: "Playwrite US Modern", cursive;
      }
      .auth-container {
        background-image: url("https://images.unsplash.com/photo-1610116306796-6fea9f4fae38?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80");
        background-size: cover;
        background-position: center;
      }
      .floating {
        animation: floating 3s ease-in-out infinite;
      }
      @keyframes floating {
        0% {
          transform: translateY(0px);
        }
        50% {
          transform: translateY(-10px);
        }
        100% {
          transform: translateY(0px);
        }
      }
    </style>
  </head>
  <body class="bg-blue-50 min-h-screen">
    <div
      class="auth-container min-h-screen flex items-center justify-center p-4"
    >
      <div
        class="w-full max-w-4xl flex flex-col md:flex-row bg-white rounded-3xl shadow-xl overflow-hidden"
      >
        <!-- Left Side - Brand Info -->
        <div
          class="w-full md:w-5/12 bg-gradient-to-br from-primary-400 to-primary-600 p-8 text-white flex flex-col justify-between relative"
        >
          <div>
            <div class="flex items-center">
              <img
                src="https://cdn-icons-png.flaticon.com/512/2436/2436636.png"
                alt="Logo"
                class="w-12 h-12 mr-3"
              />
              <h1 class="text-3xl font-bold mb-2">Tài Liệu Tiểu Học</h1>
            </div>
            <p class="text-primary-100 mb-8">
              Học vui - Học dễ - Học thông minh!
            </p>

            <div class="space-y-6 mt-8">
              <div class="flex items-start">
                <div class="flex-shrink-0">
                  <i class="fas fa-book text-primary-200 text-xl"></i>
                </div>
                <div class="ml-4">
                  <h3 class="text-lg font-bold">Bài học thú vị</h3>
                  <p class="text-sm text-primary-100">
                    Hơn 100 bài học vui nhộn cho các bạn nhỏ
                  </p>
                </div>
              </div>

              <div class="flex items-start">
                <div class="flex-shrink-0">
                  <i class="fas fa-medal text-primary-200 text-xl"></i>
                </div>
                <div class="ml-4">
                  <h3 class="text-lg font-bold">Nhận huy hiệu</h3>
                  <p class="text-sm text-primary-100">
                    Sưu tập huy hiệu khi hoàn thành bài học
                  </p>
                </div>
              </div>

              <div class="flex items-start">
                <div class="flex-shrink-0">
                  <i class="fas fa-gamepad text-primary-200 text-xl"></i>
                </div>
                <div class="ml-4">
                  <h3 class="text-lg font-bold">Trò chơi học tập</h3>
                  <p class="text-sm text-primary-100">
                    Học qua các trò chơi thú vị và bổ ích
                  </p>
                </div>
              </div>
            </div>
          </div>

          <!-- Decorative elements -->
          <img
            src="https://cdn-icons-png.flaticon.com/512/2641/2641409.png"
            alt="Kid studying"
            class="w-32 h-32 absolute bottom-5 right-5 floating"
          />

          <div class="mt-auto">
            <p class="text-sm text-primary-100">
              © 2025 Tailieutieuhoc.edu.vn - Bản quyền thuộc về Tailieutieuhoc.edu.vn
            </p>
          </div>
        </div>

        <!-- Right Side - Auth Forms -->
        <div class="w-full md:w-7/12 p-8">
          <!-- Tabs -->
          <div class="flex border-b-4 border-dotted border-secondary-200 mb-6">
            <button
              id="login-tab"
              onclick="showTab('login')"
              class="px-4 py-2 font-bold text-lg border-b-4 border-primary-500 text-primary-600 rounded-t-lg"
            >
              Đăng nhập
            </button>
            <button
              id="register-tab"
              onclick="showTab('register')"
              class="px-4 py-2 font-bold text-lg border-b-4 border-transparent text-gray-500 hover:text-gray-700 rounded-t-lg"
            >
              Đăng ký
            </button>
          </div>

          <!-- Login Form -->
          <div id="login-form" class="auth-form">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">
              Chào mừng quay trở lại!
            </h2>

            <div class="flex justify-center mb-8">
              <img
                src="https://cdn-icons-png.flaticon.com/512/2302/2302834.png"
                alt="Login"
                class="w-32 h-32"
              />
            </div>

            <form class="space-y-6" method="POST" action="{{route('auth.handle_login')}}">
                @csrf
              <div>
                <label
                  for="username"
                  class="block text-lg font-bold text-gray-700"
                  >Tên đăng nhập</label
                >
                <div class="mt-1 relative rounded-xl shadow-sm">
                  <div
                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                  >
                    <i class="fas fa-user text-primary-400"></i>
                  </div>
                  <input
                    type="email"
                    id="username"
                    name="email"
                    class="block w-full pl-10 pr-3 py-3 border-2 border-primary-200 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-300 text-lg"
                    placeholder="Nhập tên đăng nhập"
                  />
                </div>
              </div>

              <div>
                <label
                  for="password"
                  class="block text-lg font-bold text-gray-700"
                  >Mật khẩu</label
                >
                <div class="mt-1 relative rounded-xl shadow-sm">
                  <div
                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                  >
                    <i class="fas fa-lock text-primary-400"></i>
                  </div>
                  <input
                    type="password"
                    id="password"
                    name="password"
                    class="block w-full pl-10 pr-10 py-3 border-2 border-primary-200 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-300 text-lg"
                    placeholder="Nhập mật khẩu"
                  />
                  <div
                    class="absolute inset-y-0 right-0 pr-3 flex items-center"
                  >
                    <i
                      class="fas fa-eye text-primary-400 cursor-pointer hover:text-primary-500"
                      onclick="togglePasswordVisibility('password')"
                    ></i>
                  </div>
                </div>
              </div>

              <div class="flex items-center justify-between">
                <div class="flex items-center">
                  <input
                    id="remember-me"
                    name="remember-me"
                    type="checkbox"
                    class="h-5 w-5 text-primary-600 focus:ring-primary-500 border-gray-300 rounded"
                  />
                  <label
                    for="remember-me"
                    class="ml-2 block text-base text-gray-700"
                    >Ghi nhớ đăng nhập</label
                  >
                </div>

                <div class="text-base">
                  <a
                    href="#"
                    class="font-medium text-primary-600 hover:text-primary-500"
                    >Quên mật khẩu?</a
                  >
                </div>
              </div>

              <div>
                <button
                  type="submit"
                  class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-lg font-bold text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500"
                >
                  Đăng nhập
                </button>
              </div>
            </form>

            {{-- <div class="mt-6">
              <p class="text-center text-base text-gray-500">
                Bạn là phụ huynh hoặc giáo viên?
              </p>
              <button
                class="mt-2 w-full flex justify-center py-2 px-4 border border-gray-300 rounded-xl shadow-sm text-base font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none"
              >
                <i class="fas fa-user-tie mr-2"></i>
                Đăng nhập dành cho người lớn
              </button>
            </div> --}}
          </div>

          <!-- Register Form -->
          <div id="register-form" class="auth-form hidden">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">
              Tạo tài khoản mới
            </h2>

            <div class="flex justify-center mb-8">
              <img
                src="https://cdn-icons-png.flaticon.com/512/3456/3456426.png"
                alt="Register"
                class="w-32 h-32"
              />
            </div>

            <form class="space-y-6" method="POST" enctype="multipart/form-data" action="{{route('auth.handle_register')}}">
                @csrf
              <div>
                <label
                  for="full-name"
                  class="block text-lg font-bold text-gray-700"
                  >Họ và tên</label
                >
                <div class="mt-1">
                  <input
                    type="text"
                    id="full-name"
                    name="name"
                    class="block w-full px-4 py-3 border-2 border-primary-200 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-300 text-lg"
                    placeholder="Nhập họ và tên"
                  />
                </div>
              </div>

              <div>
                <label for="age" class="block text-lg font-bold text-gray-700"
                  >Bạn là ?</label
                >
                <div class="mt-1">
                  <select
                    id="age"
                    name="role"
                    class="block w-full px-4 py-3 border-2 border-primary-200 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-300 text-lg"
                  >
                    <option value="1">Học sinh</option>
                    <option value="2">Giáo viên</option>
                  </select>
                </div>
              </div>

              <div>
                <label
                  for="register-username"
                  class="block text-lg font-bold text-gray-700"
                  >Email</label
                >
                <div class="mt-1 relative rounded-xl shadow-sm">
                  <div
                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                  >
                    <i class="fas fa-user text-primary-400"></i>
                  </div>
                  <input
                    type="email"
                    id="register-username"
                    name="email"
                    class="block w-full pl-10 pr-3 py-3 border-2 border-primary-200 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-300 text-lg"
                    placeholder="xxx@xzc"
                  />
                </div>
              </div>

              <div>
                <label
                  for="register-password"
                  class="block text-lg font-bold text-gray-700"
                  >Mật khẩu</label
                >
                <div class="mt-1 relative rounded-xl shadow-sm">
                  <div
                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                  >
                    <i class="fas fa-lock text-primary-400"></i>
                  </div>
                  <input
                    type="password"
                    id="register-password"
                    name="password"
                    class="block w-full pl-10 pr-10 py-3 border-2 border-primary-200 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-300 text-lg"
                    placeholder="Tạo mật khẩu"
                  />
                  <div
                    class="absolute inset-y-0 right-0 pr-3 flex items-center"
                  >
                    <i
                      class="fas fa-eye text-primary-400 cursor-pointer hover:text-primary-500"
                      onclick="togglePasswordVisibility('register-password')"
                    ></i>
                  </div>
                </div>
              </div>

              {{-- <div>
                <label class="block text-lg font-bold text-gray-700"
                  >Chọn nhân vật</label
                >
                <div class="mt-3 grid grid-cols-4 gap-4">
                  <div class="flex flex-col items-center">
                    <div
                      class="w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center cursor-pointer border-4 border-transparent hover:border-primary-500"
                    >
                      <img
                        src="https://cdn-icons-png.flaticon.com/512/3940/3940417.png"
                        alt="Avatar 1"
                        class="w-12 h-12"
                      />
                    </div>
                  </div>
                  <div class="flex flex-col items-center">
                    <div
                      class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center cursor-pointer border-4 border-transparent hover:border-primary-500"
                    >
                      <img
                        src="https://cdn-icons-png.flaticon.com/512/3940/3940415.png"
                        alt="Avatar 2"
                        class="w-12 h-12"
                      />
                    </div>
                  </div>
                  <div class="flex flex-col items-center">
                    <div
                      class="w-16 h-16 rounded-full bg-yellow-100 flex items-center justify-center cursor-pointer border-4 border-transparent hover:border-primary-500"
                    >
                      <img
                        src="https://cdn-icons-png.flaticon.com/512/3940/3940419.png"
                        alt="Avatar 3"
                        class="w-12 h-12"
                      />
                    </div>
                  </div>
                  <div class="flex flex-col items-center">
                    <div
                      class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center cursor-pointer border-4 border-transparent hover:border-primary-500"
                    >
                      <img
                        src="https://cdn-icons-png.flaticon.com/512/3940/3940405.png"
                        alt="Avatar 4"
                        class="w-12 h-12"
                      />
                    </div>
                  </div>
                </div>
              </div> --}}

              <div class="flex items-center">
                <input
                  id="parent-consent"
                  {{-- name="parent-consent" --}}
                  type="checkbox"
                  class="h-5 w-5 text-primary-600 focus:ring-primary-500 border-gray-300 rounded"
                />
                <label
                  for="parent-consent"
                  class="ml-2 block text-base text-gray-700"
                >
                  Tôi đã có sự đồng ý của phụ huynh
                </label>
              </div>

              <div>
                <button
                  type="submit"
                  class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-lg font-bold text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500"
                >
                  Tạo tài khoản
                </button>
              </div>
            </form>

            {{-- <div class="mt-6">
              <p class="text-center text-base text-gray-500">
                Bạn là phụ huynh hoặc giáo viên?
              </p>
              <button
                class="mt-2 w-full flex justify-center py-2 px-4 border border-gray-300 rounded-xl shadow-sm text-base font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none"
              >
                <i class="fas fa-user-tie mr-2"></i>
                Đăng ký dành cho người lớn
              </button>
            </div> --}}
          </div>
        </div>
      </div>
    </div>

    <script>
      function showTab(tabName) {
        // Hide all forms
        document.querySelectorAll(".auth-form").forEach((form) => {
          form.classList.add("hidden");
        });

        // Show the selected form
        document.getElementById(tabName + "-form").classList.remove("hidden");

        // Update tab styles
        document
          .querySelectorAll("#login-tab, #register-tab")
          .forEach((tab) => {
            tab.classList.remove("border-primary-500", "text-primary-600");
            tab.classList.add("border-transparent", "text-gray-500");
          });

        document
          .getElementById(tabName + "-tab")
          .classList.remove("border-transparent", "text-gray-500");
        document
          .getElementById(tabName + "-tab")
          .classList.add("border-primary-500", "text-primary-600");
      }

      function togglePasswordVisibility(inputId) {
        const passwordInput = document.getElementById(inputId);
        const type =
          passwordInput.getAttribute("type") === "password"
            ? "text"
            : "password";
        passwordInput.setAttribute("type", type);

        // Toggle eye icon
        const eyeIcon = event.currentTarget;
        if (type === "text") {
          eyeIcon.classList.remove("fa-eye");
          eyeIcon.classList.add("fa-eye-slash");
        } else {
          eyeIcon.classList.remove("fa-eye-slash");
          eyeIcon.classList.add("fa-eye");
        }
      }
    </script>
  </body>
</html>
