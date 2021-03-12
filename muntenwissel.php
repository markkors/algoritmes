<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Snoepautomaat</title>
    <style>
        div {
            margin: 2%;
        }
    </style>
</head>
<body>
<h1>Snoep automaat</h1>
    <p>In deze oefening maak je een programma voor een snoepautomaat. Je kunt iets kopen voor een bepaald bedrag en de automaat rekent zelf uit aan de hand van
        het bedrag wat jij invoert welke bedrag aan wisselgeld teruggegeven moet worden. Het programma geeft aan welke munten en hoeveel er teruggegeven worden.</p>
    <p>De volgende munten kan de automaat teruggeven:</p>
    <ul>
        <li>1 cent</li>
        <li>2 cent</li>
        <li>5 cent</li>
        <li>10 cent</li>
        <li>20 cent</li>
        <li>50 cent</li>
        <li>1 euro</li>
        <li>2 euro</li>
    </ul>
    <p>De automaat bevat de volgende inhoud</p>
    <div>
        <select id="selected_candy">
                <option value="100">Mars (1 euro)</option>
                <option value="70">Roze koek (70 cent)</option>
                <option value="150">Cola (1,50 euro)</option>
        </select>
    </div>
    <div>
        <input id="amount" type="number" placeholder="Muntinvoer in centen">
    </div>

    <button id="dopay">betaal</button>

    <div>Je krijgt terug:</div>
    <div id="return"></div>
<script>
    let coins = [{"cent":200,"desc":"2 euro"},
        {"cent":100,"desc":"1 euro"},
        {"cent":50,"desc":"50 cent"},
        {"cent":20,"desc":"20 cent"},
        {"cent":10,"desc":"10 cent"},
        {"cent":5,"desc":"5 cent"},
        {"cent":2,"desc":"2 cent"},
        {"cent":1,"desc":"1 cent"}];
    let candy = document.getElementById("selected_candy");

    document.getElementById("dopay").addEventListener("click", function () {
        let amount = document.getElementById("amount").value;
        let candy_value = candy.value;
        let candy_name = candy[candy.selectedIndex].text;
        console.log(`You have choosen: ${candy_name} for ${candy_value} `);
        console.log(`You have paided ${amount} cent`);
        let money_back = amount - candy_value;
        switch(true) {
            case money_back == 0:
                console.log("genoeg betaald, artikel aan klant, geef geen geld terug");
                break;
            case money_back < 0:
                console.log("niet genoeg betaald, geen artikel");
                break;
            case money_back > 0:
                console.log(`te veel betaald, artikel voor klant, geef geld terug: ${money_back} cent`);
                let return_coins = []; // verzamel array voor teruggave muntjes
                for(let i = 0; i<coins.length;i++) {
                    let count=money_back / coins[i]["cent"];
                    if(count!=0) {
                        //console.log(`Aantal ${coins[i]["desc"]} munten:${parseInt(count)}`);
                        if(parseInt(count)>0) {
                            return_coins.push([coins[i],parseInt(count)]);
                        }
                        money_back = money_back % coins[i]["cent"]; // restand via de modulus operator %
                    }
                }

                let result_container = document.getElementById("return");
                while(result_container.hasChildNodes()) {
                   result_container.removeChild(result_container.firstChild);
                };
                return_coins.forEach(function (e) {
                   let c = document.createElement("div");
                   c.innerText = `${e[1]} ${(e[1]>1) ? 'munten' : 'munt'} van ${e[0]["desc"]}`
                   result_container.appendChild(c);
                });
        }

    });
</script>
</body>
</html>