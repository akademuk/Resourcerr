function switchClicked(currentSwitchState, switchToToggle, location) {
    var switchElement = document.getElementById(switchToToggle);
    switchElement.checked = currentSwitchState.checked;
    window.location = location
}
