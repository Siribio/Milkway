function checkSelections() {
  var selects = [
    document.getElementById("add1"),
    document.getElementById("add2"),
    document.getElementById("add3"),
    document.getElementById("add4"),
    document.getElementById("add5"),
    document.getElementById("add6"),];

    for (var i = 0; i < selects.length; i++) {
      for (var j = 0; j < selects[i].options.length; j++) {
        selects[i].options[j].disabled = false;
      }
    }
  
    for (var i = 0; i < selects.length; i++) {
      if (selects[i].value) {
        for (var j = 0; j < selects.length; j++) {
          if (i != j) {
            for (var k = 0; k < selects[j].options.length; k++) {
              if (selects[j].options[k].value == selects[i].value) {
                selects[j].options[k].disabled = true;
              }
            }
          }
        }
      }
    }
}
