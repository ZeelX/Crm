window.addEventListener('load', () => {
    const checkAll: HTMLInputElement = document.querySelector('[data-check-all]');
    const checkboxs: NodeListOf<HTMLInputElement> = document.querySelectorAll('[data-client-infos]');
    const btnExport: HTMLInputElement = document.querySelector('[data-export]');
    let arrayData = [];
    checkAll.addEventListener("click", () => {
        if (checkAll.checked) {
            while (arrayData.length) {
                arrayData.pop();
            }
            let selectedBox: NodeListOf<HTMLInputElement> = document.querySelectorAll('[data-client-infos]');
            for (const infos of selectedBox) {
                arrayData.push(infos.dataset.clientInfos.split(","));
            }
            selectedBox.forEach((element) => {
                element.checked = true
            })
        }
        if (!checkAll.checked) {
            let selectedBox: NodeListOf<HTMLInputElement> = document.querySelectorAll('[data-client-infos]');
            selectedBox.forEach((element) => {
                element.checked = false;
            })
            while (arrayData.length) {
                arrayData.pop();
            }
        }
    });
    for (const checkbox of checkboxs) {
        checkbox.addEventListener("click", () => {
            if (checkbox.checked) {
               arrayData.push(checkbox.dataset.clientInfos.split(","));
            }
            if (!checkbox.checked) {
                let finder = checkbox.dataset.clientInfos.split(",");
                let i = 0;
                for (const object of arrayData) {
                    if (areSame(object, finder)) {
                        arrayData.splice(i, 1);
                    }
                    i += 1;
                }
            }
        })
    }

    btnExport.addEventListener("click", () => {

        exportToTxt("listeClients.csv", arrayData, ["Id", "Nom", "Entreprise", "email"]);
    })
});
////////////////////////////////////////
export const exportToTxt = (filename: string, rows: object[], headers?: string[]): void => {
    if (!rows || !rows.length) {
        return;
    }
    const separator: string = ",";
    const keys: string[] = Object.keys(rows[0]);
    let columHearders: string[];
    if (headers) {
        columHearders = headers;
    } else {
        columHearders = keys;
    }
    const csvContent =
        "sep=,\n" +
        columHearders.join(separator) +
        '\n' +
        rows.map(row => {
            return keys.map(k => {
                let cell = row[k] === null || row[k] === undefined ? '' : row[k];
                cell = cell instanceof Date
                    ? cell.toLocaleString()
                    : cell.toString().replace(/"/g, '""');
                if (cell.search(/("|,|\n)/g) >= 0) {
                    cell = `"${cell}"`;
                }
                return cell;
            }).join(separator);
        }).join('\n');
    const blob = new Blob([csvContent], {type: 'text/csv;charset=utf-8;'});
    // if (navigator.msSaveBlob) { // using IE 10 + (yeurk)
    //     navigator.msSaveBlob(blob, filename);
    // } else {
    const link = document.createElement('a');
    if (link.download !== undefined) {
        // Browsers that support HTML5 download attribute
        const url = URL.createObjectURL(blob);
        link.setAttribute('href', url);
        link.setAttribute('download', filename);
        link.style.visibility = 'hidden';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
    // }
}

function areSame(array1, array2) {
    if (array1.length === array2.length) {
        return array1.every((element, index) => {
            return element === array2[index];
        });
    }
    return false;
}