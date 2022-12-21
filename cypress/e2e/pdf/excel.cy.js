
// describe("Mencetak data pegawai dengan format Excel", () => {
//     it("Berhasil mencetak data pegawai", () => {
//         cy.visit("http://localhost:8000/employee");
//         cy.get("form").within(() => {
//             cy.get('#yourUsername').type('admin');
//             cy.get('#yourPassword').type('admin');
//             cy.contains('Masuk').click();
//         });
//         cy.contains('Excel').click();
//     });
// });
// describe("Mencetak data sapi dengan format Excel", () => {
//     it("Berhasil mencetak data sapi", () => {
//         cy.visit("http://localhost:8000/farm");
//         cy.get("form").within(() => {
//             cy.get('#yourUsername').type('admin');
//             cy.get('#yourPassword').type('admin');
//             cy.contains('Masuk').click();
//         });
//         cy.contains('Excel').click();
//     });
// });
// describe("Mencetak data Kesehatan sapi dengan format Excel", () => {
//     it("Berhasil mencetak data Kesehatan sapi", () => {
//         cy.visit("http://localhost:8000/healthfarm");
//         cy.get("form").within(() => {
//             cy.get('#yourUsername').type('admin');
//             cy.get('#yourPassword').type('admin');
//             cy.contains('Masuk').click();
//         });
//         cy.contains('Excel').click();
//     });
// });
// describe("Mencetak data stok pakan dengan format Excel", () => {
//     it("Berhasil mencetak data stok pakan", () => {
//         cy.visit("http://localhost:8000/historyfeed");
//         cy.get("form").within(() => {
//             cy.get('#yourUsername').type('admin');
//             cy.get('#yourPassword').type('admin');
//             cy.contains('Masuk').click();
//         });
//         cy.contains('Excel').click();
//     });
// });
describe("Mencetak data stok obat dengan format Excel", () => {
    it("Berhasil mencetak data stok obat", () => {
        cy.visit("http://localhost:8000/historydrug");
        cy.get("form").within(() => {
            cy.get('#yourUsername').type('admin');
            cy.get('#yourPassword').type('admin');
            cy.contains('Masuk').click();
        });
        cy.contains('Excel').click();
    });
});


