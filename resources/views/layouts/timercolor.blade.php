@if((date("Y-m-d") >= date("Y-m-d", strtotime(Auth::user()->ot_start))) && (date("Y-m-d") <= date("Y-m-d", strtotime(Auth::user()->ot_end))))
    @if($btn_check == 'time1')
    @elseif($btn_check == 'time2')
                <script> document.getElementById("indicator1").style.background = "#5cb85c"; </script>
                <script> document.getElementById("tindicator1").style.color = "white"; </script>
    @elseif($btn_check == 'time3')
                <script> document.getElementById("indicator1").style.background = "#5cb85c"; </script>
                <script> document.getElementById("tindicator1").style.color = "white"; </script>
                <script> document.getElementById("indicator2").style.background = "#5cb85c"; </script>
                <script> document.getElementById("tindicator2").style.color = "white"; </script>
    @elseif($btn_check == 'time4')
                <script> document.getElementById("indicator1").style.background = "#5cb85c"; </script>
                <script> document.getElementById("tindicator1").style.color = "white"; </script>
                <script> document.getElementById("indicator2").style.background = "#5cb85c"; </script>
                <script> document.getElementById("tindicator2").style.color = "white"; </script>
                <script> document.getElementById("indicator3").style.background = "#5cb85c"; </script>
                <script> document.getElementById("tindicator3").style.color = "white"; </script>
    @elseif($btn_check == 'time5')
                <script> document.getElementById("indicator1").style.background = "#5cb85c"; </script>
                <script> document.getElementById("tindicator1").style.color = "white"; </script>
                <script> document.getElementById("indicator2").style.background = "#5cb85c"; </script>
                <script> document.getElementById("tindicator2").style.color = "white"; </script>
                <script> document.getElementById("indicator3").style.background = "#5cb85c"; </script>
                <script> document.getElementById("tindicator3").style.color = "white"; </script>
                <script> document.getElementById("indicator4").style.background = "#5cb85c"; </script>
                <script> document.getElementById("tindicator4").style.color = "white"; </script>
    @elseif($btn_check == 'time6')
                <script> document.getElementById("indicator1").style.background = "#5cb85c"; </script>
                <script> document.getElementById("tindicator1").style.color = "white"; </script>
                <script> document.getElementById("indicator2").style.background = "#5cb85c"; </script>
                <script> document.getElementById("tindicator2").style.color = "white"; </script>
                <script> document.getElementById("indicator3").style.background = "#5cb85c"; </script>
                <script> document.getElementById("tindicator3").style.color = "white"; </script>
                <script> document.getElementById("indicator4").style.background = "#5cb85c"; </script>
                <script> document.getElementById("tindicator4").style.color = "white"; </script>
                <script> document.getElementById("indicator5").style.background = "#5cb85c"; </script>
                <script> document.getElementById("tindicator5").style.color = "white"; </script>
    @else
                <script> document.getElementById("indicator1").style.background = "#5cb85c"; </script>
                <script> document.getElementById("tindicator1").style.color = "white"; </script>
                <script> document.getElementById("indicator2").style.background = "#5cb85c"; </script>
                <script> document.getElementById("tindicator2").style.color = "white"; </script>
                <script> document.getElementById("indicator3").style.background = "#5cb85c"; </script>
                <script> document.getElementById("tindicator3").style.color = "white"; </script>
                <script> document.getElementById("indicator4").style.background = "#5cb85c"; </script>
                <script> document.getElementById("tindicator4").style.color = "white"; </script>
                <script> document.getElementById("indicator5").style.background = "#5cb85c"; </script>
                <script> document.getElementById("tindicator5").style.color = "white"; </script>
                <script> document.getElementById("indicator6").style.background = "#5cb85c"; </script>
                <script> document.getElementById("tindicator6").style.color = "white"; </script>
    @endif
@else
    @if($btn_check == 'time1')
    @elseif($btn_check == 'time2')
                <script> document.getElementById("indicator1").style.background = "#5cb85c"; </script>
                <script> document.getElementById("tindicator1").style.color = "white"; </script>
    @elseif($btn_check == 'time3')
                <script> document.getElementById("indicator1").style.background = "#5cb85c"; </script>
                <script> document.getElementById("tindicator1").style.color = "white"; </script>
                <script> document.getElementById("indicator2").style.background = "#5cb85c"; </script>
                <script> document.getElementById("tindicator2").style.color = "white"; </script>
    @elseif($btn_check == 'time4')
                <script> document.getElementById("indicator1").style.background = "#5cb85c"; </script>
                <script> document.getElementById("tindicator1").style.color = "white"; </script>
                <script> document.getElementById("indicator2").style.background = "#5cb85c"; </script>
                <script> document.getElementById("tindicator2").style.color = "white"; </script>
                <script> document.getElementById("indicator3").style.background = "#5cb85c"; </script>
                <script> document.getElementById("tindicator3").style.color = "white"; </script>
    @else
                <script> document.getElementById("indicator1").style.background = "#5cb85c"; </script>
                <script> document.getElementById("tindicator1").style.color = "white"; </script>
                <script> document.getElementById("indicator2").style.background = "#5cb85c"; </script>
                <script> document.getElementById("tindicator2").style.color = "white"; </script>
                <script> document.getElementById("indicator3").style.background = "#5cb85c"; </script>
                <script> document.getElementById("tindicator3").style.color = "white"; </script>
                <script> document.getElementById("indicator4").style.background = "#5cb85c"; </script>
                <script> document.getElementById("tindicator4").style.color = "white"; </script>
    @endif
@endif