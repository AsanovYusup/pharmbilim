
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.0/angular.min.js" integrity="sha512-I3QHDZRfE9q6y96S+0cmCRSoH4PUFhg8n+8RWQ+uI4AQTSg8jEcd/bYqQszYG1SXBsQ/Z7MRl2IsCzvdZNcEfg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.0/angular-messages.min.js" integrity="sha512-2KSvARQr0CuaW0XK28jSB9rSWDDc+CVXPZ1UuCvrBLjlhfqnWQg74Gu5AgdCrlN1fSBKEjD1G/OjJvq6LFFIOA==" crossorigin="anonymous"></script>

<script>
var app = angular.module('academia', ['ngMessages']);
app.controller('angLmsController', function($scope, $http) {
    
        
    $scope.initAngData = function(data) {
        if(data=='')
        {
            $scope.series = '';
            $scope.content_type = '';
            return;
        }
         data = JSON.parse(data);
         $scope.content_type    = data.content_type;
    }
});
 
</script>