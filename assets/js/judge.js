$(document).ready(function() {
    $('#submit-score-form').submit(function(e) {
        const points = parseInt($('#points').val());
        if (points < 1 || points > 100) {
            alert('Points must be between 1 and 100.');
            e.preventDefault();
        }
    });
});