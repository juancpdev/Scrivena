// widget-script.js
document.addEventListener("DOMContentLoaded", function() {
  var cajaSection = document.querySelector('.criptos');

  if(cajaSection) {
    var container = document.createElement('div');
    container.className = 'tradingview-widget-container criptomonedas';
  
    var widget = document.createElement('div');
    widget.className = 'tradingview-widget-container__widget';
  
    container.appendChild(widget);
  
    cajaSection.parentNode.insertBefore(container, cajaSection.nextSibling);
  
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = 'https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js';
    script.async = true;
    container.appendChild(script);
  
    script.innerHTML = `
        {
            "symbols": [
                {
                    "proName": "FOREXCOM:SPXUSD",
                    "title": "S&P 500"
                },
                {
                    "proName": "FOREXCOM:NSXUSD",
                    "title": "US 100"
                },
                {
                    "proName": "BITSTAMP:BTCUSD",
                    "title": "Bitcoin"
                },
                {
                    "proName": "BITSTAMP:ETHUSD",
                    "title": "Ethereum"
                },
                {
                    "description": "USD/MXN",
                    "proName": "FX:USDMXN"
                },
                {
                    "description": "EUR/USD",
                    "proName": "FX:EURUSD"
                }
            ],
            "showSymbolLogo": true,
            "colorTheme": "dark",
            "isTransparent": false,
            "displayMode": "adaptive",
            "locale": "es"
        }
    `;
  }
});
  