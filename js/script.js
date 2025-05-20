// // script.js
// const isLoggedIn = false;

// const icon = document.getElementById("userIcon");
// const dropdown = document.getElementById("dropdownMenu");

// icon.addEventListener("click", () => {
//   dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
// });

// if (isLoggedIn) {
//   dropdown.innerHTML = `
//     <a href="#">Hồ sơ</a>
//     <a href="#">Đăng xuất</a>
//   `;
// } else {
//   dropdown.innerHTML = `
//     <a href="#">Đăng nhập</a>
//   `;
// }


 // Lấy các phần tử DOM cần dùng
 const avatarToggle = document.getElementById('avatarToggle');
 const dropdownMenu = document.getElementById('dropdownMenu');

 // Biến trạng thái đăng nhập (giả lập)
 let isLoggedIn = false;

 // Hàm hiển thị nội dung menu dropdown tùy theo trạng thái đăng nhập
 function renderDropdown() {
   dropdownMenu.innerHTML = isLoggedIn
     ? '<a href="#">Đăng xuất</a>'
     : `
   <a href="#">Hồ sơ</a>
   <a href="#" onclick="logout()">Đăng xuất</a>
 `;
 }

 // Khi click vào avatar: bật/tắt dropdown
 avatarToggle.addEventListener('click', function (e) {
   e.stopPropagation(); // Ngăn chặn sự kiện click lan ra ngoài (tránh đóng ngay)
   dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
   renderDropdown(); // Cập nhật nội dung dropdown theo trạng thái
 });

 // Khi click vào bất kỳ đâu ngoài avatar, dropdown sẽ ẩn
 document.addEventListener('click', function () {
   dropdownMenu.style.display = 'none';
 });

 // Xử lý sự kiện click vào liên kết trong dropdown
 dropdownMenu.addEventListener('click', function (e) {
   e.preventDefault(); // Ngăn chuyển trang
   if (e.target.tagName === 'A') {
     isLoggedIn = !isLoggedIn; // Đảo trạng thái đăng nhập
     dropdownMenu.style.display = 'none'; // Ẩn menu
     alert(isLoggedIn ? '"Đăng nhập thành công!' : 'Đã đăng xuất!'); // Thông báo
   }
 });

 // Hiển thị nội dung menu lần đầu
 renderDropdown();