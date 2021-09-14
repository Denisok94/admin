PF.H = class Helper
{
    static moneyFormat(intValue)
    {
        let value = intValue + "";
        for (let i = value.length - 5; i > 0; i -= 3)
        {
            value = value.substr(0, i) + ' ' + value.substr(i);
        }
        if (value.endsWith('00'))
        {
            value = value.substr(0, value.length - 2);
        }
        else
        {
            if (value !== '0')
            {
                value = value.substr(0, value.length - 2) + '.' + value.substr(value.length - 2);
            }
        }
        return value;
    }

    static ucfirst(str)
    {
        if (str.length)
        {
            str = str.charAt(0).toUpperCase() + str.slice(1);
        }
        return str;
    }

    static sizeFormat(bytes, si = true)
    {
        var thresh = si ? 1000 : 1024;
        if (Math.abs(bytes) < thresh)
        {
            return bytes + ' Б';
        }
        var units = si
            ? ['КБ', 'МБ', 'ГБ', 'ТБ', 'ПБ']
            : ['KiB', 'MiB', 'GiB', 'TiB',];
        var u = -1;
        do
        {
            bytes /= thresh;
            ++u;
        }
        while (Math.abs(bytes) >= thresh && u < units.length - 1);
        return bytes.toFixed(1) + ' ' + units[u];
    }

    //https://active-vision.ru/blog/js-settimout-i-sleep-v-javascript/
    /**
     * Выполнить через N времени
     * ```
     * Util.sleep(ms).then(() => { });
     * ```
     * @param {*} ms 
     * @returns 
     */
    static sleep(ms)
    {
        return new Promise(resolve => setTimeout(resolve, ms));
    }

    /**
     * @param {*} number count
     * @param {*} titles ['', 'персона', 'персоны', 'персон']
     * @returns 
     */
    static spell(number, titles)
    {
        if (typeof number !== 'number')
        {
            number = parseInt(number);
        }
        let cases = [2, 0, 1, 1, 1, 2];
        let text;
        if (titles.length === 1)
        {
            text = titles[0];
        }
        if (number === 0)
        {
            text = titles[0];
        }
        else
        {
            titles.shift();
            text = titles[(number % 100 > 4 && number % 100 < 20) ? 2 : cases[(number % 10 < 5) ? number % 10 : 5]];
        }
        text = PF.H.applyContext(text, { v: number });
        return text;
    }

    static isJsonString(str)
    {
        try
        {
            JSON.parse(str);
        }
        catch (e)
        {
            return false;
        }
        return true;
    }

    static isFloat(n)
    {
        return Number(n) === n && n % 1 !== 0;
    }

    static isArray(data)
    {
        return Object.prototype.toString.call(data) == '[object Array]'
    }

    static browser()
    {
        let ua = navigator.userAgent;

        if (ua.search(/MSIE/) > 0) return 'Internet Explorer';
        if (ua.search(/Firefox/) > 0) return 'Firefox';
        if (ua.search(/Opera/) > 0) return 'Opera';
        if (ua.search(/Chrome/) > 0) return 'Google Chrome';
        if (ua.search(/Safari/) > 0) return 'Safari';
        if (ua.search(/Konqueror/) > 0) return 'Konqueror';
        if (ua.search(/Iceweasel/) > 0) return 'Debian Iceweasel';
        if (ua.search(/SeaMonkey/) > 0) return 'SeaMonkey';

        // Браузеров очень много, все вписывать смысле нет, Gecko почти везде встречается
        if (ua.search(/Gecko/) > 0) return 'Gecko';

        // а может это вообще поисковый робот
        return 'Search Bot';
    }
    //------------------

    /* Получить элемент по id */
    static d(el)
    {
        return document.getElementById(el);
    }

    /* создать элемент*/
    static c(el)
    {
        return document.createElement(el);
    }

    //------------------

    /* Чтение данных из кук */
    static getCookie(name)
    {
        let matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }

    /* Запись данных в куки */
    static setCookie(name, value)
    {
        let date = new Date(Date.now() + (6 * 30 * 24 * 60 * 60 * 1000));
        date = date.toUTCString();
        document.cookie = name + "=" + value + "; path=/; expires=" + date; // domain=s-denis.ru; secure";
    }

    //------------------
    /**
     * Повторять каждые N времени (бесполезная хрень)
     * @param {*} ms.
     * 5 сек 5000;
     * 5 мин 300000;
     * 10 мин 600000;
     * час 3600000.
     * @param {*} callback 
     * @param {*} errorCallback 
     */
    static interval(ms, callback, errorCallback)
    {
        try
        {
            setInterval(() =>
            {
                callback()
            }, ms);
        } catch (error)
        {
            console.log(error);
            errorCallback();
        }
    }

    //------------------

    static createUUID()
    {
        return ([1e7] + -1e3 + -4e3 + -8e3 + -1e11).replace(/[018]/g, c => (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16));
    }

    static useTrait(object, trait, use = true)
    {
        if (use === true)
        {
            if (!PF.H.hasTrait(object, trait))
            {
                new trait(object);
            }
        }
    }

    static hasTrait(object, trait)
    {
        if (object.traits !== undefined)
        {
            if (trait.name in object.traits)
            {
                return true;
            }
        }
        return false;
    }

    static isSame(v1, v2)
    {
        return v1 === 0 && v2 === 0 ? 1 / v1 === 1 / v2 : v1 !== v1 && v2 !== v2 || v1 === v2;
    }

    static randomString(length = 10)
    {
        let text = '';
        let possible = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        for (let i = 0; i < length; i++)
        {
            text += possible.charAt(Math.floor(Math.random() * possible.length));
        }
        return text;
    }

    static hash(target)
    {
        if (typeof target === 'object')
        {
            target = JSON.stringify(target);
        }
        let res = 0;
        let len = target.length;
        for (let i = 0; i < len; i++)
        {
            res = res * 31 + target.charCodeAt(i);
            res = res & res;
        }
        return res;
    }

    static create(classObject, ...args)
    {
        if (!PF.H.isClass(classObject))
        {
            classObject = classObject(...args);
        }
        return new classObject(...args);
    }

    static get(object, path, undefinedValue = undefined, nullValue = null, after = (v) => v)
    {
        if (path === undefined)
        {
            return undefinedValue;
        }
        let target = object;
        let parts = path.toString().split('.');
        for (let i = 0; i < parts.length; i++)
        {
            if (!(target instanceof Object))
            {
                return undefinedValue;
            }
            // if (target.dataContainer !== undefined && target.dataContainer[parts[i]] !== undefined)
            // 	{
            // 	target = target.dataContainer[parts[i]];
            // 	}
            else
            {
                target = target[parts[i]];
            }
            if (target === undefined)
            {
                return undefinedValue;
            }
            if (target === null)
            {
                return nullValue;
            }
        }
        return after(target);
    }

    static set(object, path, value)
    {
        let [target, key] = PF.H.findTarget(object, path);
        target[key] = value;
    }

    static findTarget(object, path, dataKeysIndex = undefined)
    {
        let target = object;
        let parts = path.split('.');
        for (let i = 0; i < parts.length - 1; i++)
        {
            if (target[parts[i]] === undefined || target[parts[i]] === null)
            {
                if (dataKeysIndex !== undefined)
                {
                    target[parts[i]] = new PF.Entity();
                    target.set(dataKeysIndex + parts[i], true);
                }
                else
                {
                    target[parts[i]] = {};
                }
            }
            target = target[parts[i]];
        }
        return [target, parts[parts.length - 1]];
    }

    static applyContext(string, context)
    {
        if (typeof string === "function")
        {
            return string(context);
        }
        if (typeof string !== "string")
        {
            return "";
        }

        let offset = 0;
        while (string.indexOf('@{', offset) > -1)
        {
            let begin = string.indexOf('@{', offset) + 2;
            let end = string.indexOf('}', begin);

            if (string.length - 1 > begin && begin < end)
            {
                let fullIndex = string.substring(begin, end);
                let defaultValue = '';
                let index = fullIndex;
                if (fullIndex.indexOf('|') >= 0)
                {
                    [index, defaultValue] = fullIndex.split('|');
                }
                let value = PF.H.get(context, index, defaultValue, defaultValue);

                let regexp = new RegExp("\\@\\{" + fullIndex + "\\}", 'g');
                string = string.replace(`@{${fullIndex}}`, value);
            }
            offset = begin - 2;
        }

        return string;
    }

    static compareByPks(a = {}, b = {})
    {
        if (a === undefined || b === undefined || a === null || b === null)
        {
            return false;
        }
        if ((typeof a.isNull === 'function' && a.isNull() === true) && (typeof b.isNull === 'function' && b.isNull() === true))
        {
            return true;
        }
        if (a['#pks'] === undefined)
        {
            a['#pks'] = ['id'];
        }
        for (let i = 0; i < a['#pks'].length; i++)
        {
            let pk = a['#pks'][i];
            if (PF.H.get(a, pk) !== PF.H.get(b, pk))
            {
                return false;
            }
        }
        return true;
    };


    static decimalAdjust(type, value, exp)
    {
        if (typeof exp === 'undefined' || +exp === 0)
        {
            return Math[type](value);
        }
        value = +value;
        exp = +exp;
        if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0))
        {
            return NaN;
        }
        value = value.toString().split('e');
        value = Math[type](+(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp)));
        value = value.toString().split('e');
        return +(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp));
    }

    static round(value, exp)
    {
        return PF.H.decimalAdjust('round', value, exp);
    }

    static ceil(value, exp)
    {
        return PF.H.decimalAdjust('ceil', value, exp);
    }

    static floor(value, exp)
    {
        return PF.H.decimalAdjust('floor', value, exp);
    }

};

String.prototype.splice = function (startIndex, length, insertString)
{
    return this.substring(0, startIndex) + insertString + this.substring(startIndex + length);
};