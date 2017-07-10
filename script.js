function share(i){
    
            var modal = document.getElementById("myModal="+i);

            var btn = document.getElementById("myBtn="+i);

            var span = document.getElementsByClassName("close")[0];

            btn.onclick = function() {

                modal.style.display = "block";

            }


            window.onclick = function(event) {

                if (event.target == modal) {

                    modal.style.display = "none";

                }

            }
}