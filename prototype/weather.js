
let date=document.getElementById('date');
let date_today=new Date();
date.innerText=currentDate(date_today);

 function currentDate(today){
    let days=["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday"];
    let months=["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sept","Oct","Nov","Dec"];
    let year=today.getFullYear();
    let month=months[today.getMonth()];
    let date=today.getDate();
    let day=days[today.getDay()];
    return `${date} ${month} ${day} ${year}`;
 }
 
fetch('https://api.openweathermap.org/data/2.5/weather?q=Sunderland&units=metric&appid=a091831eddd73e569e687ab4c187d0bb')
.then(response => response.json()
    // if(!response.ok){
    //     alert("no weather found");
    //     throw new error("no weather found");
    // }
    // return response.json();
)
.then((data)=>{
    tempvalue= data['main']['temp'];
    cityvalue=data['name'];
    conditionvalue=data['weather'][0]['description'];
    cloudyvalue=data['clouds']['all'];
    humidityvalue=data['main']['humidity'];
    windvalue=data['wind']['speed'];
    pressurevalue=data['main']['pressure']; 
    wind_directionvalue=data['wind']['deg'];

    document.querySelector('.weather_condition').innerHTML= conditionvalue;
    document.querySelector('.city').innerHTML=cityvalue;
    document.querySelector('.Humidity').innerHTML= "Humidity: "+ humidityvalue + "%";
    document.querySelector('.pressure').innerHTML="Pressure: " + pressurevalue + "Hpa";
    document.querySelector('.cloudy').innerHTML="Cloudy Value: " + cloudyvalue + "%";
    document.querySelector('.wind_speed').innerHTML="Wind Speed: " + windvalue + "m/s";
    document.querySelector('.wind_direction').innerHTML="Wind Direction: " + wind_directionvalue + "&#176";


})