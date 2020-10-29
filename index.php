<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.0/axios.min.js" integrity="sha512-DZqqY3PiOvTP9HkjIWgjO6ouCbq+dxqWoJZ/Q+zPYNHmlnI2dQnbJ5bxAHpAMw+LXRm4D72EIRXzvcHQtE8/VQ==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <title>Online Chat</title>
    <style>
    .bold{
        font-weight: bold;
    }
    </style>
</head>
<body>

    <div id="index">
    {{ name }}
        <textarea v-model="message" id="" cols="30" rows="10" v-on:keyup.enter="send()"></textarea>
        <button @click="send()">Send</button>


        <div class="message_area" >
         <p v-for="output in outputs" v-bind:class="(output['name'] == name) ? bold : ''">{{ output['name'] }}: {{ output['message'] }}</p>
        </div>  
    </div>




    
    <script> 
        var app = new Vue({
            el: "#index",
            data: {
                message: '',
                outputs: '',
                name: '',
                bold: 'bold'
            },
            methods: {
                send: function(){
                    // this.message = this.hello;
                    // this.hello = '';
                    axios.post("server/index.php", {
                        action: 'sendMessage', 
                        name: this.name,
                        message: this.message
                    }).then(function(response){
                        app.message = '';
                        app.fetchMessages();
                    });
                },
                fetchMessages: function(){
                    axios.post('server/index.php', {
                        action: 'fethMessage'
                    }).then(function(response){
                        app.outputs = response.data;
                    });
                }
            }, 
            created: function() {
                this.fetchMessages();
            }, 
        }); 
        app.name = prompt("Please Enter your name"); 
        var timerID = setInterval(app.fetchMessages, 1000);
        app.fetchMessages();
    </script>
</body>
</html>

