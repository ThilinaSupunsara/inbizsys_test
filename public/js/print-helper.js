function generateAndPrint(data, page, perPage) {
    let tableRows = '';

    data.forEach((supplier, index) => {
        let rowNumber = (page - 1) * perPage + (index + 1);
        let phone = supplier.phone ? supplier.phone : '-';

        tableRows += `
            <tr>
                <td>${rowNumber}</td>
                <td>${supplier.name}</td>
                <td>${supplier.email}</td>
                <td>${phone}</td>
                <td>${supplier.address}</td>
            </tr>
        `;
    });

    const printContent = `
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Print Report</title>
            <script src="https://unpkg.com/pagedjs/dist/paged.polyfill.js"></script>
            <style>
                @page {
                    size: A4;
                    margin: 20mm;
                    @bottom-left { content: "My Company Name Pvt Ltd"; font-size: 10pt; color: #666; }
                    @bottom-right { content: "Page " counter(page) " of " counter(pages); font-size: 10pt; color: #666; }
                }
                body { font-family: sans-serif; }
                h1 { text-align: center; font-size: 24pt; margin-bottom: 10px; }
                .date { text-align: right; font-size: 10pt; color: #666; margin-bottom: 20px; }
                table { width: 100%; border-collapse: collapse; }
                th, td { border: 1px solid #ddd; padding: 8px; text-align: left; font-size: 11pt; }
                th { background-color: #f3f4f6; }
                tr { break-inside: avoid; }
            </style>
        </head>
        <body>
            <h1>Supplier Management Report</h1>
            <div class="date">Printed on: ${new Date().toLocaleDateString()} ${new Date().toLocaleTimeString()}</div>

            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                    </tr>
                </thead>
                <tbody>
                    ${tableRows}
                </tbody>
            </table>

            <script>
                class PrintingHandler extends Paged.Handler {
                    constructor(chunker, polisher, caller) { super(chunker, polisher, caller); }
                    afterPreview(pages) {
                        setTimeout(() => { window.print(); }, 1000);
                    }
                }
                Paged.registerHandlers(PrintingHandler);
            </script>
        </body>
        </html>
    `;

    
    const oldIframe = document.getElementById('print-iframe');
    if (oldIframe) oldIframe.remove();

    const iframe = document.createElement('iframe');
    iframe.id = 'print-iframe';
    iframe.style.position = 'fixed';
    iframe.style.right = '0';
    iframe.style.bottom = '0';
    iframe.style.width = '0';
    iframe.style.height = '0';
    iframe.style.border = '0';

    document.body.appendChild(iframe);

    const doc = iframe.contentWindow.document;
    doc.open();
    doc.write(printContent);
    doc.close();
}
