var usernameInput = document.getElementById('username')
var passwordInput = document.getElementById('pwd')
var repasswordInput = document.getElementById('repwd')
var loginForm = document.getElementById('loginForm')

// 提交验证：用户名不能为空，密码不能为空，两次输入的密码不能不一致，不能含有非法字符
loginForm.onsubmit = function () {
  var patten = '[^A-Za-z0-9]';
  var unameUnsafe = usernameInput.value.search(patten)
  var passwordUnsafe = passwordInput.value.search(patten)

  if (unameUnsafe !== -1) {
    alert('用户名含有非法字符！')
    return false
  } else if (passwordUnsafe !== -1) {
    alert('密码含有非法字符！')
    return false
  } else {

  }

  if (passwordInput.value !== repasswordInput.value) {
    alert('两次输入的密码不一致！')
    return false
  } else if (usernameInput.value === '') {
    alert('用户名不能为空！')
    return false
  } else if (passwordInput.value === '') {
    alert('密码不能为空！')
    return false
  } else {
    return true
  }
}