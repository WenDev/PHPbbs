var addForm = document.getElementById('addForm')
var title = document.getElementById('title')
var content = document.getElementById('content')

addForm.onkeydown = function (ev) {
  if (ev.keyCode === 13) {
    return false
  }
}

addForm.onsubmit = function () {
  if (title.value === '') {
    alert('标题不能为空！')
    return false
  } else if (content.value === '') {
    alert('内容不能为空！')
    return false
  } else {
    return true
  }
}