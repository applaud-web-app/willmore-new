<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div id="calendlyDv" style="height:100vh;"></div>
    <script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js"></script>
    <script>
        Calendly.initInlineWidget({
            "url": 'https://calendly.com/chitragupta147896325/test-event',
            "parentElement": document.getElementById('calendlyDv'),
            "prefill": {
            },
            "utm": {}
        });
        
    </script>

    <script>
        function isCalendlyEvent(e) {
            return e.origin === "https://calendly.com" && e.data.event && e.data.event.indexOf("calendly.") === 0;
        };
        
        window.addEventListener("message", function(e) {
        if(isCalendlyEvent(e)) {
            if(e.data.event=='calendly.event_scheduled'){
                alert('event scheduled');
            }
            /* Example to get the name of the event */
            console.log("Event name:", 'asdf');
            
            /* Example to get the payload of the event */
            console.log("Event details:", e.data);
        }
        });
    </script>
    
    <!-- Calendly link widget begin -->
{{-- <link href="https://assets.calendly.com/assets/external/widget.css" rel="stylesheet">
<script src="https://assets.calendly.com/assets/external/widget.js" type="text/javascript" async></script>
<a href="" onclick="Calendly.initPopupWidget({url: 'https://calendly.com/chitragupta147896325/test-event'});return false;">Schedule time with me</a>

<script>
    function isCalendlyEvent(e) {
        return e.origin === "https://calendly.com" && e.data.event && e.data.event.indexOf("calendly.") === 0;
    };
    
    window.addEventListener("message", function(e) {
    if(isCalendlyEvent(e)) {
        if(e.data.event=='calendly.event_scheduled'){
            alert('event scheduled');
        }
        /* Example to get the name of the event */
        console.log("Event name:", 'asdf');
        
        /* Example to get the payload of the event */
        console.log("Event details:", e.data);
    }
    });
</script> --}}

<!-- Calendly link widget end -->
</body>
</html>