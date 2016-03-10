

function filterData(point) {
    var currentFixation = [];
    var potentialFixation = [];

    var saccadeTrashold = 100;

    if (currentFixation.length === 0) {
        currentFixation.push(point);

        return;
    }

    if (currentFixation.length !== 0 && potentialFixation.length !== 0) {
        //TODO calculate distance
        //
        fixations.forEach(function(fixation) {

            distance = getDistance(point, fixation);

        });

        if (true) {

            if (distance <= saccadeTrashold) {
                currentFixation.push(point);
                potentialFixation = [];

                return newFixation(currentFixation);
            } else {
                potentialFixation = [];
                potentialFixation.push(point);

                return lastArrayItem(currentFixation);
            }
        } else {
            if (distance < saccadeTrashold) {
                potentialFixation.push(point);

                var tmp = newFixation(potentialFixation);

                potentialFixation = [];

                return tmp;
            } else {
                var tmp2 = potentialFixation;
                potentialFixation = [];
                potentialFixation.push(point);

                return tmp2;
            }
        }
    } else {
        if (distance  > saccadeTrashold) {
            potentialFixation.push(point);

            return lastArrayItem(currentFixation);
        } else {
            currentFixation.push(point);

            return lastArrayItem(currentFixation);
        }
    }
}

function newFixation(array) {

    var a = 0;
    var b = 0;

    for (var i = 0; i < array.length; i++) {
        a += (i+1)*array[i];
        b += i+1;
    }

    return a/b;
}


function lastArrayItem(array) {

    return array[array.length - 1];
}

function getDistance(point, fixation) {


    return 0;
}


