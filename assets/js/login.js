document.addEventListener("DOMContentLoaded", function () {
    const togglePassword = document.querySelector("#togglePassword");
    const password = document.querySelector("#password");
    const toggleConfirmPassword = document.querySelector("#toggleConfirmPassword");
    const confirmPassword = document.querySelector("#confirmPassword");

    // Xử lý hiển thị mật khẩu cho trường "Mật khẩu"
    if (togglePassword && password) {
        togglePassword.addEventListener("click", function () {
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            this.src = type === "text" ? "./assets/icons/eye.svg" : "./assets/icons/lock.svg";
        });
    }

    // Xử lý hiển thị mật khẩu cho trường "Xác nhận mật khẩu"
    if (toggleConfirmPassword && confirmPassword) {
        toggleConfirmPassword.addEventListener("click", function () {
            const type = confirmPassword.getAttribute("type") === "password" ? "text" : "password";
            confirmPassword.setAttribute("type", type);
            this.src = type === "text" ? "./assets/icons/eye.svg" : "./assets/icons/lock.svg";
        });
    }
});
// document.addEventListener("DOMContentLoaded", function () {
//     const form = document.querySelector('.auth__form');
//     const password = document.querySelector("#password");
//     const confirmPassword = document.querySelector("#confirmPassword");
//     const confirmPasswordError = document.querySelector("#confirmPasswordError");

//     // Xử lý khi form được submit
//     form.addEventListener("submit", function (event) {
//         let isValid = true; // Cờ kiểm tra tính hợp lệ

//         // Kiểm tra xác nhận mật khẩu
//         if (password.value !== confirmPassword.value) {
//             isValid = false;
//             confirmPasswordError.style.display = "block"; // Hiển thị lỗi
//         } else {
//             confirmPasswordError.style.display = "none"; // Ẩn lỗi nếu khớp
//         }

//         if (!isValid) {
//             event.preventDefault(); // Ngăn form được submit
//         }
//     });

//     // Kiểm tra theo thời gian thực khi người dùng nhập
//     confirmPassword.addEventListener("input", function () {
//         if (password.value !== confirmPassword.value) {
//             confirmPasswordError.style.display = "block"; // Hiển thị lỗi
//         } else {
//             confirmPasswordError.style.display = "none"; // Ẩn lỗi nếu khớp
//         }
//     });
// });
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector('.auth__form');
    const password = document.querySelector("#password");
    const confirmPassword = document.querySelector("#confirmPassword");
    const confirmPasswordError = document.querySelector("#confirmPasswordError");

    // Hàm kiểm tra mật khẩu khớp
    function validatePasswords() {
        if (password.value !== confirmPassword.value) {
            confirmPasswordError.style.display = "block"; // Hiển thị lỗi
            return false; // Trả về false nếu không khớp
        } else {
            confirmPasswordError.style.display = "none"; // Ẩn lỗi nếu khớp
            return true; // Trả về true nếu khớp
        }
    }

    // Xử lý khi form được submit
    form.addEventListener("submit", function (event) {
        const isValid = validatePasswords(); // Gọi hàm kiểm tra
        if (!isValid) {
            event.preventDefault(); // Ngăn submit nếu không hợp lệ
            
        }
    });

    // Kiểm tra theo thời gian thực trên cả hai trường
    password.addEventListener("input", validatePasswords);
    confirmPassword.addEventListener("input", validatePasswords);
});