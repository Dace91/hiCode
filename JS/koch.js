/**
 * @author: Antoine07
 * @description: code for Naoudi, Fenley, Camille and Louise
 */
(function () {

    var Koch = {
        pattern: 'GADADA',
        Pattern: '',
        iteration: 0,
        thick: 0,
        vec:[],
        max: 0,
        container: 'drawing',
        render: null,

        init: function (init) {
            Koch.pattern = init.pattern || 'GADADA';
            Koch.iteration = init.iteration || 0;
            Koch.thick = 300/Math.pow(3, Koch.iteration - 1);
            Koch.Pattern = Koch.getPattern();
            Koch.render = SVG(Koch.container).size(Koch.width(), Koch.height());
            Koch.setPos();
            Koch.max = Math.round(Koch.Pattern.length);
        },
        width: function () {
            return 1280;
        },
        height: function () {
            return 1165;
        },
        draw: function () {
            Koch.render.polygon(Koch.vec).fill('#f03').stroke({ width: 1});
        },

        setPos: function () {
            var angle = 0;
            var Pattern = Koch.Pattern;
            var x = 100;
            var y = 300;
            Koch.vec = [];

            for (var i = 0; i < Pattern.length; i++) {
                switch (Pattern[i]) {
                    case 'G':
                        angle = 60 + angle;
                        break;

                    case 'D':
                        angle = 240 + angle;
                        break;

                    default:
                        break;
                }

                Koch.vec.push([x,y]);
                x = x + Koch.thick * Math.cos(angle * (Math.PI / 180.0));
                y = y + Koch.thick * Math.sin(angle * (Math.PI / 180.0));
                Koch.vec.push([x,y]);
            }
        },
        getPattern: function () {
            for (var i = 0; i < Koch.iteration; i++) {
                Koch.pattern = Koch.pattern.replace(/A/gi, 'AGADAGA');
            }

            return Koch.pattern.split('A').join('');
        },
        restore: function () {
            var elem = document.getElementById(Koch.container);
            elem.removeChild(elem.childNodes[0]);
        }
    };

    var init = {
        iteration: 0
    };

    Koch.init(init);
    Koch.draw();

    range.addEventListener("input", function () {

        var range = this.value;

        var init = {
            iteration: range
        };

        Koch.init(init);
        Koch.restore();
        Koch.draw();

        number.innerHTML = Koch.max;

    });

})();
