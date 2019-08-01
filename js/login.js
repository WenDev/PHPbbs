var usernameInput = document.getElementById('username')
var passwordInput = document.getElementById('pwd')
var loginForm = document.getElementById('loginForm')

// 提交验证：用户名不能为空，密码不能为空，两次输入的密码不能不一致
loginForm.onsubmit = function () {
  if (usernameInput.value === '') {
    alert('用户名不能为空！')
    return false
  } else if (passwordInput.value === '') {
    alert('密码不能为空！')
    return false
  } else {
    return true
  }
}