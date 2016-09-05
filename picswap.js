var dykframe = 0;
var dyklistindex = 0;
var dyklist = new Array(
"Every year lots of trees get cut for no reason whatsoever.",
"The first person on the moon was Neil Armstrong.",
"South Africa is a really nice place to live.",
"Not all moths and butterflies spin silk.",
"The moon is not really made of cheese.",
"Climate is the average of daily weather conditions over a period of between 20-50 years.",
"You can survive without eating for weeks, but you will only live 11 days without sleeping.",
"If you sit for more than 11 hours a day, there's a 50% chance that it will make you severely sick in 2 yrs.",
"There are at least 6 people in the world who look exactly like you. There's a 9% chance that you'll meet one of them in your lifetime.",
"Sleeping without a pillow reduces back pain and keeps your spine stronger.",
"A person's height is determined by their father, and their weight is determined by their mother.",
"If a part of your body falls asleep, you can almost always wake it up by shaking your head.",
"There are three things the human brain cannot resist noticing - Food, attractive people and danger.",
"Right-handed people tend to chew food on their right side.",
"Putting dry tea bags in gym bags or smelly shoes will absorb the unpleasant odour.",
"According to Albert Einstein, if honey bees were to disappear from earth, humans would be dead within 4 years.",
"There are so many kind of apples, that if you ate a new one everyday, it would take over 20 years to try them all.",
"Laziness and inactivity kills just as many people as smoking.",
"People who laugh a lot are healthier than those who don't.",
"A human brain has a capacity to store 5 times as much information as Wikipedia",
"Our brain uses same amount of power as 10-watt light bulb!!",
"Our body gives enough heat in 30 mins to boil 1.5 litres of water!!",
"Stomach acid (conc. HCl) is strong enough to dissolve razor blades!!",
"Take a 10-30 minute walk every day. & while you walk, SMILE. It is the ultimate antidepressant.",
"The sun rises in the east."
)

function picswaps(){

  //DYK = $("#dykText");
  
  setInterval("updateDYK()", 15000);
 
 // setInterval("dotoggle()", 2000);
  setInterval( "dotoggleText()", 7500);
}


function doDYK(){
  
  updateDYK();
}

function dotoggle(){
  $(".optImage").fadeToggle(500);
  
}
function dotoggleText(){
  
  $("#dykText").slideToggle(5000);
  
}

function updateDYK(){
  dykframe++;
  if (dykframe >= dyklist.length-1){
    dykframe = 0;
  } // end if
  $('#dykText').html(dyklist[dykframe]);
} // end updateImage
