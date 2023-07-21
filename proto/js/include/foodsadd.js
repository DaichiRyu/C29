/**
 * @enum {Number}
 */
const Genre = {
    FISH: {
        value: 1,
        name: "魚"
    },
    RAW_MEAT: {
        value: 2,
        name: "肉"
    },
    VEGETABLE: {
        value: 3,
        name: "野菜"
    },
    FRUIT: {
        value: 4,
        name: "フルーツ"
    },
    OTHER: {
        value: 5,
        name: "その他"
    }
};

/**
 * @enum {Number}
 */
const StrgLoc = {
    FRIDGE: {
        value: 1,
        name: "冷蔵庫"
    },
    FREEZER: {
        value: 2,
        name: "冷凍庫"
    },
    NORMTEMP: {
        value: 3,
        name: "常温"
    }
};



/**
 * @class 食品クラス。
 */
class Food {

    /**
     * 
     * @param {String} name 食品名。
     * @param {Number} number 食品の個数。
     * @param {Number} storage 食品の保存場所。
     * @param {Number} genre 食品のジャンル。
     * @param {Date} [ub=null] 消費期限
     * @param {Date} [bb=null] 賞味期限。
     * @param {Number} [money] 食品の価格。日本円。
     * @constructor 
     */
    constructor(name="", number=1, storage=0, genre=0, ub=null, bb=null, money=0) {
        this.id = null;
        this.name = name;
        this.number = number;
        this.storage = storage;
        this.genre = genre;
        this.ub = ub;
        this.bb = bb;
        this.money = money;
        this.userID = null;
    }

    generateDomElem() {
        let container = document.createElement("div");
        let leftContainer = document.createElement("div");
        let rightContainer = document.createElement("div");
        let containerNumber = document.createElement("div");
        let containerUb = document.createElement("div");
        let containerBb = document.createElement("div");
        let containerStorage = document.createElement("div");
        let containerGenre = document.createElement("div");
        let containerMoney = document.createElement("div");
        let labelName = document.createElement("label");
        let labelNumber = document.createElement("label");
        let labelUb = document.createElement("label");
        let labelBb = document.createElement("label");
        let labelStorage = document.createElement("label");
        let labelGenre = document.createElement("label");
        let labelMoney = document.createElement("label");
        let inputName = document.createElement("input");
        let inputNumber = document.createElement("input");
        let inputUb = document.createElement("input");
        let inputBb = document.createElement("input");
        let inputStorage = document.createElement("select");
        let inputGenre = document.createElement("select");
        let inputMoney = document.createElement("input");

        container.classList.add("food");
        leftContainer.classList.add("food-left");
        rightContainer.classList.add("food-right");

        labelName.innerText = "食品名";
        labelNumber.innerText = "個数";
        labelUb.innerText = "消費期限";
        labelBb.innerText = "賞味期限";
        labelStorage.innerText = "保存場所";
        labelGenre.innerText = "ジャンル";
        labelMoney.innerText = "金額";

        inputName.type = "text";
        inputNumber.type = "number";
        inputUb.type = "date";
        inputBb.type = "date";
        inputMoney.type = "number";

        inputName.className="food-name editable-input";
        inputNumber.className="food-number editable-input";
        inputUb.className="food-ub editable-input";
        inputBb.className="food-bb editable-input";
        inputStorage.className="food-storage select-storage editable-input";
        inputGenre.className="food-genre select-genre editable-input";
        inputMoney.className="food-money editable-input";

        Object.keys(StrgLoc).forEach(entry => {
            let elem = document.createElement("option");
            elem.value = StrgLoc[entry].value;
            elem.innerText = StrgLoc[entry].name;
            if(elem.value == this.storage) elem.selected = true;

            inputStorage.append(elem);
        });

        Object.keys(Genre).forEach(entry => {
            let elem = document.createElement("option");
            elem.value = Genre[entry].value;
            elem.innerText = Genre[entry].name;
            if(elem.value == this.genre) elem.selected = true;

            inputGenre.append(elem);
        });

        inputName.value = this.name;
        inputNumber.value = this.number;
        inputUb.value = this.ub;
        inputBb.value = this.bb;
        inputMoney.value = this.money;

        leftContainer.append(labelName);
        leftContainer.append(inputName);
        containerNumber.append(labelNumber);
        containerNumber.append(inputNumber);
        containerUb.append(labelUb);
        containerUb.append(inputUb);
        containerBb.append(labelBb);
        containerBb.append(inputBb);
        containerStorage.append(labelStorage);
        containerStorage.append(inputStorage);
        containerGenre.append(labelGenre);
        containerGenre.append(inputGenre);
        containerMoney.append(labelMoney);
        containerMoney.append(inputMoney);
        rightContainer.append(containerNumber);
        rightContainer.append(containerUb);
        rightContainer.append(containerBb);
        rightContainer.append(containerStorage);
        rightContainer.append(containerGenre);
        rightContainer.append(containerMoney);
        container.append(leftContainer);
        container.append(rightContainer);

        return container;
    }

    /**
     * @return {HTMLDivElement} 
     */
    static generateDomElem() {
        let container = document.createElement("div");
        let leftContainer = document.createElement("div");
        let rightContainer = document.createElement("div");
        let containerNumber = document.createElement("div");
        let containerUb = document.createElement("div");
        let containerBb = document.createElement("div");
        let containerStorage = document.createElement("div");
        let containerGenre = document.createElement("div");
        let containerMoney = document.createElement("div");
        let labelName = document.createElement("label");
        let labelNumber = document.createElement("label");
        let labelUb = document.createElement("label");
        let labelBb = document.createElement("label");
        let labelStorage = document.createElement("label");
        let labelGenre = document.createElement("label");
        let labelMoney = document.createElement("label");
        let inputName = document.createElement("input");
        let inputNumber = document.createElement("input");
        let inputUb = document.createElement("input");
        let inputBb = document.createElement("input");
        let inputStorage = document.createElement("select");
        let inputGenre = document.createElement("select");
        let inputMoney = document.createElement("input");

        container.classList.add("food");
        leftContainer.classList.add("food-left");
        rightContainer.classList.add("food-right");

        labelName.innerText = "食品名";
        labelNumber.innerText = "個数";
        labelUb.innerText = "消費期限";
        labelBb.innerText = "賞味期限";
        labelStorage.innerText = "保存場所";
        labelGenre.innerText = "ジャンル";
        labelMoney.innerText = "金額";

        inputName.type = "text";
        inputNumber.type = "number";
        inputUb.type = "date";
        inputBb.type = "date";
        inputMoney.type = "number";

        inputName.className="food-name editable-input";
        inputNumber.className="food-number editable-input";
        inputUb.className="food-ub editable-input";
        inputBb.className="food-bb editable-input";
        inputStorage.className="food-storage select-storage editable-input";
        inputGenre.className="food-genre select-genre editable-input";
        inputMoney.className="food-money editable-input";

        inputNumber.value="1";

        Object.keys(StrgLoc).forEach(entry => {
            let elem = document.createElement("option");
            elem.value = StrgLoc[entry].value;
            elem.innerText = StrgLoc[entry].name;

            inputStorage.append(elem);
        });

        Object.keys(Genre).forEach(entry => {
            let elem = document.createElement("option");
            elem.value = Genre[entry].value;
            elem.innerText = Genre[entry].name;

            inputGenre.append(elem);
        });

        leftContainer.append(labelName);
        leftContainer.append(inputName);
        containerNumber.append(labelNumber);
        containerNumber.append(inputNumber);
        containerUb.append(labelUb);
        containerUb.append(inputUb);
        containerBb.append(labelBb);
        containerBb.append(inputBb);
        containerStorage.append(labelStorage);
        containerStorage.append(inputStorage);
        containerGenre.append(labelGenre);
        containerGenre.append(inputGenre);
        containerMoney.append(labelMoney);
        containerMoney.append(inputMoney);
        rightContainer.append(containerNumber);
        rightContainer.append(containerUb);
        rightContainer.append(containerBb);
        rightContainer.append(containerStorage);
        rightContainer.append(containerGenre);
        rightContainer.append(containerMoney);
        container.append(leftContainer);
        container.append(rightContainer);

        return container;
    }

}