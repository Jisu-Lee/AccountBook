function checkPW() {
        var pw = document.getElementById("password").value;
        var pwck = document.getElementById("password_re").value;

        if (pw != pwck) {
            alert('비밀번호 재입력이 일치하지 않습니다. 다시 입력해 주세요');
            return false;
        }

        else if(pw == pwck) return true;
    }
