function switchClicked(currentSwitchState, switchToToggle) {
    var switchElement = document.getElementById(switchToToggle);
    switchElement.checked = currentSwitchState.checked;
    window.location = "partners/partners.html"  
  }