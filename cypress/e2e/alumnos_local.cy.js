describe('Registro de alumnos en la interfaz del proyecto', () => {

  it('registra un alumno y lo muestra en la tabla', () => {
    // Visita la página local de alumnos
    cy.visit('/alumnos-ui')
    
    // Llena los campos usando los selectores data-cy
    cy.get('[data-cy="codigo"]').type('A001')
    cy.get('[data-cy="nombre"]').type('Lucía Ramos')
    cy.get('[data-cy="email"]').type('lucia@instituto.edu')
    
    // Hace clic en el botón de guardar
    cy.get('[data-cy="btn-guardar"]').click()
    
    // Comprueba que los textos de éxito aparezcan en la pantalla
    cy.contains('Alumno registrado correctamente')
    cy.contains('Lucía Ramos')
    cy.contains('lucia@instituto.edu')
    })

    it('muestra errores cuando faltan campos obligatorios', () => {
 cy.visit('/alumnos-ui')
 cy.get('[data-cy="btn-guardar"]').click()
 cy.contains('The codigo field is required')
 cy.contains('The nombre field is required')
 cy.co
  })

})