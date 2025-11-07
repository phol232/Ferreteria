import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { ApiService } from '../../services/api.service';
import { HttpClientModule } from '@angular/common/http';
import { ModalComponent } from '../../shared/modal/modal.component';

@Component({
  selector: 'app-suppliers-list',
  standalone: true,
  imports: [CommonModule, HttpClientModule, FormsModule, ModalComponent],
  templateUrl: './suppliers-list.component.html'
})
export class SuppliersListComponent implements OnInit {
  activeTab: 'proveedores' | 'movimientos' = 'proveedores';
  
  // Proveedores
  suppliers: any[] = [];
  showSupplierModal = false;
  editingSupplier: any = null;
  savingSupplier = false;
  supplierFormData: any = {
    nombreProveedor: '',
    rucProveedor: '',
    correoProveedor: '',
    telefonoProveedor: '',
    direccionProveedor: ''
  };

  // Movimientos
  movimientos: any[] = [];
  showMovimientoModal = false;
  showDetalleModal = false;
  selectedMovimiento: any = null;
  editingMovimiento: any = null;
  savingMovimiento = false;
  selectedSupplierId: string = '';
  productosCarrito: any[] = [];
  nuevoProducto: any = {
    codigoProducto: '',
    nombreProducto: '',
    descripcionProducto: '',
    cantidad: 1,
    costoProducto: 0,
    gananciaProducto: 0,
    precioProducto: 0,
    imageProducto: ''
  };

  constructor(private apiService: ApiService) {}

  ngOnInit() {
    this.loadSuppliers();
    this.loadMovimientos();
  }

  // ===== PROVEEDORES =====
  loadSuppliers() {
    this.apiService.getProveedores().subscribe({
      next: (data) => this.suppliers = data,
      error: () => this.suppliers = []
    });
  }

  getInitials(name: string): string {
    if (!name) return '??';
    return name.split(' ').map(n => n[0]).join('').toUpperCase().slice(0, 2);
  }

  openCreateSupplierModal() {
    this.editingSupplier = null;
    this.supplierFormData = {
      nombreProveedor: '',
      rucProveedor: '',
      correoProveedor: '',
      telefonoProveedor: '',
      direccionProveedor: ''
    };
    this.showSupplierModal = true;
  }

  editSupplier(supplier: any) {
    this.editingSupplier = supplier;
    this.supplierFormData = { ...supplier };
    this.showSupplierModal = true;
  }

  closeSupplierModal() {
    this.showSupplierModal = false;
    this.editingSupplier = null;
  }

  saveSupplier() {
    if (!this.supplierFormData.nombreProveedor || !this.supplierFormData.rucProveedor || !this.supplierFormData.correoProveedor) {
      alert('Por favor complete todos los campos requeridos');
      return;
    }

    // Validate RUC (11 digits)
    if (!/^\d{11}$/.test(this.supplierFormData.rucProveedor)) {
      alert('El RUC debe contener exactamente 11 dígitos numéricos');
      return;
    }

    // Validate email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(this.supplierFormData.correoProveedor)) {
      alert('Por favor ingrese un correo electrónico válido');
      return;
    }

    this.savingSupplier = true;
    const request = this.editingSupplier
      ? this.apiService.updateProveedor(this.editingSupplier.id, this.supplierFormData)
      : this.apiService.createProveedor(this.supplierFormData);

    request.subscribe({
      next: () => {
        this.loadSuppliers();
        this.closeSupplierModal();
        this.savingSupplier = false;
      },
      error: (err) => {
        console.error('Error saving supplier:', err);
        alert('Error al guardar el proveedor');
        this.savingSupplier = false;
      }
    });
  }

  deleteSupplier(supplier: any) {
    if (confirm(`¿Está seguro de eliminar a ${supplier.razonSocial || supplier.nombreProveedor}?`)) {
      this.apiService.deleteProveedor(supplier.id).subscribe({
        next: () => this.loadSuppliers(),
        error: () => alert('Error al eliminar el proveedor')
      });
    }
  }

  // ===== MOVIMIENTOS =====
  loadMovimientos() {
    this.apiService.getMovimientos().subscribe({
      next: (data) => this.movimientos = data,
      error: () => this.movimientos = []
    });
  }

  openMovimientoModal() {
    this.editingMovimiento = null;
    this.selectedSupplierId = '';
    this.productosCarrito = [];
    this.resetNuevoProducto();
    this.showMovimientoModal = true;
  }

  editarMovimiento(movimiento: any) {
    this.editingMovimiento = movimiento;
    this.selectedSupplierId = movimiento.idProveedor.toString();
    this.productosCarrito = movimiento.detalles.map((d: any) => ({
      codigoProducto: d.codigoProducto,
      nombreProducto: d.nombreProducto,
      descripcionProducto: d.descripcionProducto,
      cantidad: d.cantidad,
      costoProducto: d.costoProducto,
      gananciaProducto: d.gananciaProducto,
      precioProducto: d.precioProducto,
      imageProducto: d.imageProducto || ''
    }));
    this.resetNuevoProducto();
    this.showMovimientoModal = true;
  }

  closeMovimientoModal() {
    this.showMovimientoModal = false;
    this.editingMovimiento = null;
  }

  resetNuevoProducto() {
    this.nuevoProducto = {
      codigoProducto: '',
      nombreProducto: '',
      descripcionProducto: '',
      cantidad: 1,
      costoProducto: 0,
      gananciaProducto: 0,
      precioProducto: 0,
      imageProducto: ''
    };
  }

  calcularPrecio() {
    const costo = parseFloat(this.nuevoProducto.costoProducto) || 0;
    const ganancia = parseFloat(this.nuevoProducto.gananciaProducto) || 0;
    this.nuevoProducto.precioProducto = costo + ganancia;
  }

  agregarProducto() {
    if (!this.nuevoProducto.codigoProducto || !this.nuevoProducto.nombreProducto) {
      alert('Por favor complete el código y nombre del producto');
      return;
    }

    this.productosCarrito.push({ ...this.nuevoProducto });
    this.resetNuevoProducto();
  }

  eliminarProducto(index: number) {
    this.productosCarrito.splice(index, 1);
  }

  guardarMovimiento() {
    if (!this.selectedSupplierId) {
      alert('Por favor seleccione un proveedor');
      return;
    }

    if (this.productosCarrito.length === 0) {
      alert('Por favor agregue al menos un producto');
      return;
    }

    this.savingMovimiento = true;

    const data = {
      idProveedor: parseInt(this.selectedSupplierId),
      tipoMovimiento: 'entrada',
      descripcion: 'Entrada de inventario',
      fechaMovimiento: new Date().toISOString().split('T')[0],
      productos: this.productosCarrito
    };

    const request = this.editingMovimiento
      ? this.apiService.updateMovimiento(this.editingMovimiento.id, data)
      : this.apiService.createMovimiento(data);

    request.subscribe({
      next: () => {
        this.loadMovimientos();
        this.closeMovimientoModal();
        this.savingMovimiento = false;
        alert(this.editingMovimiento ? 'Movimiento actualizado exitosamente' : 'Movimiento creado exitosamente');
      },
      error: (err) => {
        console.error('Error saving movement:', err);
        alert('Error al guardar el movimiento');
        this.savingMovimiento = false;
      }
    });
  }

  verDetalleMovimiento(movimiento: any) {
    this.selectedMovimiento = movimiento;
    this.showDetalleModal = true;
  }

  closeDetalleModal() {
    this.showDetalleModal = false;
    this.selectedMovimiento = null;
  }

  eliminarMovimiento(movimiento: any) {
    if (confirm('¿Está seguro de eliminar este movimiento?')) {
      this.apiService.deleteMovimiento(movimiento.id).subscribe({
        next: () => this.loadMovimientos(),
        error: () => alert('Error al eliminar el movimiento')
      });
    }
  }

  formatDate(date: string): string {
    return new Date(date).toLocaleDateString('es-PE', { 
      year: 'numeric', 
      month: 'short', 
      day: 'numeric' 
    });
  }
}
