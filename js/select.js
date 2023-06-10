for (let i = 1; i <= 12; i++) {
  let option = document.createElement("option");
  option.value = i;
  option.text = i + "月";
  document.getElementById("month").appendChild(option);
}
let zodiacArry = ["牡羊座", "牡牛座", "双子座", "蟹座", "獅子座", "乙女座", "天秤座", "蠍座", "射手座", "山羊座", "水瓶座", "魚座"];
for (let i = 0; i < 12; i++) {
  let option = document.createElement("option");
  option.value = zodiacArry[i];
  option.text = zodiacArry[i];
  document.getElementById("zodiac").appendChild(option);
}
let bloodArry = ["A", "B", "O", "AB"];
for (let i = 0; i < 4; i++) {
  let option = document.createElement("option");
  option.value = bloodArry[i];
  option.text = bloodArry[i] + "型";
  document.getElementById("blood-type").appendChild(option);
}
let typeArry = [];
typeArry[0] = "ボケ";
typeArry[1] = "ツッコミ";
typeArry[2] = "ボケツッコミ両方いけるよ";
typeArry[3] = "ボケかツッコミか分からない";
for (let i = 0; i < 4; i++) {
  let option = document.createElement("option");
  option.value = typeArry[i];
  option.text = typeArry[i];
  document.getElementById("type").appendChild(option);
}