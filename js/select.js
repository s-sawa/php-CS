for (let i = 1; i <= 12; i++) {
  let option = document.createElement("option");
  option.value = i;
  option.text = i + "月";
  document.getElementById("month").appendChild(option);
}

let bloodArry = ["A", "B", "O", "AB"];
for (let i = 0; i < 4; i++) {
  let option = document.createElement("option");
  option.value = bloodArry[i];
  option.text = bloodArry[i] + "型";
  document.getElementById("blood-type").appendChild(option);
}

