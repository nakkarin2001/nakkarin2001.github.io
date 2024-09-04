// JavaScript สำหรับฟังก์ชันเพิ่มเติม (เช่น แถบนำทางที่เลื่อนขึ้นลงได้)
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
        document.querySelector(".navbar").style.top = "0";
    } else {
        document.querySelector(".navbar").style.top = "-50px";
    }
}
