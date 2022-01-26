class Day {
    _day
    _nbPlace
    _hour = ["09h00", "10h00", "11h00", "14h00", "15h00", "16h00"]

    constructor(day, nbPlace){
        this._day = day
        this._nbPlace = nbPlace
    }

    get day(){
        return this._day
    }

    get nbPlace(){
        return this._nbPlace
    }

    get hour(){
        return this._hour
    }

    set nbPlace(newNbPlace){
        this._nbPlace = newNbPlace
    }

    set hour(newHour){
        this._hour = newHour
    }
}