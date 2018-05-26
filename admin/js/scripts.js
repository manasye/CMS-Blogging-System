$(document).ready(() => {
    $('#selectAllBoxes').click(() => {
        if (this.checked) {
            $('.checkBoxes').each(() => {
                this.checked = true;
            });
        } else {
            $('.checkBoxes').each(() => {
                this.checked = true;
            });
        }
    });
});