// مثال: التحقق من صحة النموذج قبل الإرسال
document.querySelector('form').addEventListener('submit', function (e) {
    let password = document.querySelector('input[name="password"]').value;
    if (password.length < 6) {
        alert("كلمة المرور يجب أن تكون على الأقل 6 أحرف!");
        e.preventDefault(); // منع إرسال النموذج
    }
});