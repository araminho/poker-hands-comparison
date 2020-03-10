function compare() {
    let hand1 = $('#player1').val();
    let hand2 = $('#player2').val();

    const data = {
        '_token': $('input[name=_token]').val(),
        "hand1": hand1,
        "hand2": hand2,
    };

    $.ajax({
        method: 'POST',
        url: '/compare',
        data: data,
        success: function (res) {
            if (res === '1') {
                alert("Player 1 won!");
            } else if (res === '2') {
                alert("Player 2 won!");
            } else if (res === '0') {
                alert("It's a draw!");
            } else if (res === '-1') {
                alert("Wrong input!");
            }
        },
        error: function () {
            alert('Something went wrong, please try again');
        }
    });
}