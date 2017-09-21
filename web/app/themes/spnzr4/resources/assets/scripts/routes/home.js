export default {
    init() {

    },
    finalize() {
        var chars = $("#spice").blast({
            delimiter: "character",
        });
        chars.each(function(i) {
            // let elemStyle = x.style;
            $(this).css({
                    opacity: 0,
                })
                .delay(i * 45)
                .animate({
                    opacity: 1,
                }, 300);
        });
        const canvas = document.getElementById("sugar"),
            txt = document.getElementById("salt"),
            // crooks = document.getElementById("crooks"),
            isDesktop = function() {
                if (window.innerWidth > 768) {
                    return true;
                }
            };

        // if canvas exists, launch dynamic background
        if (canvas && canvas.getContext && isDesktop) {
            var ctx = canvas.getContext("2d"),
                mouse = [{
                    age: 999,
                    x: 0,
                    y: 0,
                    color: "rgba(0,0,0",
                }],
                red = 255,
                green = 222,
                blue = 1,
                timer = 0;
            // update on every mousemove
            $(document).mousemove(function(e) {
                if (e.pageY < canvas.height) {
                    // update colors
                    timer += 1;
                    if (Math.ceil(timer / 50) % 2 === 0) {
                        blue -= 1;
                    } else {
                        blue += 1;
                    }
                    if ((timer / 220 % 4) <= 1) {
                        green -= 1;
                    } else if ((timer / 220 % 4) >= 3) {
                        green += 1;
                    }
                    if ((timer / 50 % 4) <= 1) {
                        red -= 1;
                    } else if ((timer / 50 % 4) >= 3) {
                        red += 1;
                    }
                    // add initial values
                    mouse.push({
                        age: 999,
                        x: e.pageX,
                        y: e.pageY,
                        color: "rgba(" + red + "," + green + "," + blue,
                    });

                    // draw text box
                    txt.innerHTML = `<p>
                                        <span style="color:rgb(${red},0,0)">${red}</span> / 
                                        <span style="color:rgb(0,${green},0)">${green}</span> /
                                        <span style="color:rgb(0,0,${blue})">${blue}</span> /
                                        <span style="color:rgb(${red},${green},${blue})">${timer}</span>
                                        </p>`;

                    // draw canvas & update age
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    for (var i = 0; i < mouse.length; i++) {
                        mouse[i].age = mouse[i].age - 1;
                        let opacity = mouse[i].age.toString();
                        if (mouse[i].age > 10) {
                            if (mouse[i].age < 100) {
                                opacity = "0" + mouse[i].age;
                            } else if (mouse[i].age > 700) {
                                opacity = "7";
                            }
                            ctx.beginPath();
                            ctx.lineWidth = 2;
                            ctx.strokeStyle = mouse[i].color + ",0." + opacity + ")";
                            ctx.moveTo(mouse[i].x + 1, mouse[i].y - 3);
                            ctx.lineTo(mouse[i].x - 3, mouse[i].y + 4);
                            ctx.stroke();
                        } else {
                            // garbage collection
                            mouse.splice(i, 1);
                        }
                    }
                }
            });
            (function() {
                ctx.canvas.width = window.innerWidth - 20;
                ctx.canvas.height = window.innerHeight;
                txt.innerHTML = "";
            }());
        }
    },
};