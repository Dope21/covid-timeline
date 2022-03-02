// const monthIndex = document.getElementById("searchMonth");
// const dayIndex = document.getElementById("searchDate");

// const monthIndex2 = document.getElementById("searchMonth-2");
// const dayIndex2 = document.getElementById("searchDate-2");


// var daysInMonth = ['',31,29,31,30,31,30,31,31,30,31,30,31];

// function addDate(){
//   var indexConvert = parseInt(monthIndex.value);
//   var monthValue = indexConvert; //01
//   //console.log(daysInMonth[monthValue]);
//   //console.log(monthValue);

//   var optionCount = dayIndex.length; // 1 
//   var dayCount = daysInMonth[monthValue]; //31
//   if (optionCount <= dayCount){ //1 <= 31
//       for(var i = optionCount; i <= dayCount; i++){  // 2 <= 31
//         const option = document.createElement("option");//<option></option>
//         const optionText = document.createTextNode(i);//2
//         option.appendChild(optionText);//<option>2</option>
//         option.setAttribute('value',i);//<option value="2">2</option>
//         dayIndex.appendChild(option);
//       }
//   } else {
//     for (var i = dayCount; i < optionCount; i++){ 
//       var optionItem = document.querySelector('#searchDate option[value ="'+ (i+1) +'"]');
//       optionItem.remove();
//     }
//   }
// }

// function addDateSecond(){
//   var indexConvert = parseInt(monthIndex2.value);
//   var monthValue = indexConvert; //01

//   var optionCount = dayIndex2.length; 
//   var dayCount = daysInMonth[monthValue]; 
//   if (optionCount <= dayCount){ 
//       for(var i = optionCount; i <= dayCount; i++){  
//         const option = document.createElement("option");
//         const optionText = document.createTextNode(i);
//         option.appendChild(optionText);
//         option.setAttribute('value',i);
//         dayIndex2.appendChild(option);
//       }
//   } else {
//     for (var i = dayCount; i < optionCount; i++){ 
//       var optionItem = document.querySelector('#searchDate-2 option[value ="'+ (i+1) +'"]');
//       optionItem.remove();
//     }
//   }
// }

// monthIndex.onchange = addDate;
// monthIndex2.onchange = addDateSecond;
//addDate();

$(document).ready(function(){
    $('#searchButton').click(()=>{
      console.log($('tr').length-1);
      $('.timeline__table').load('timeline__table.php', {
        location : $('#location').val(),

        date: $('#date-1').val(),
        date_2 : $('#date-2').val(),
      })
    })
  
    $('#clearButton').click(()=>{
      $(".timeline__table").load('timeline__table.php', {
        clear : 'clear'
      })
    })

    
  })