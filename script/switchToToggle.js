function switchClicked(currentSwitchState, switchToToggle, location) {
   
    var switchElement = $('input','.' + switchToToggle);
    switchElement.checked = currentSwitchState.checked;
    $('.' + switchToToggle + '').addClass('checked');
    window.location = location
}
