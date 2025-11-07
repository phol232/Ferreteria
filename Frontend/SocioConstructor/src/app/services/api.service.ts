import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { environment } from '../../environments/environment';

@Injectable({
  providedIn: 'root'
})
export class ApiService {
  private baseUrl = environment.apiUrl;

  constructor(private http: HttpClient) {}

  // Productos
  getProductos(): Observable<any[]> {
    return this.http.get<any[]>(`${this.baseUrl}/productos`);
  }

  getProducto(id: number): Observable<any> {
    return this.http.get<any>(`${this.baseUrl}/productos/${id}`);
  }

  createProducto(data: any): Observable<any> {
    return this.http.post<any>(`${this.baseUrl}/productos`, data);
  }

  updateProducto(id: number, data: any): Observable<any> {
    return this.http.put<any>(`${this.baseUrl}/productos/${id}`, data);
  }

  deleteProducto(id: number): Observable<any> {
    return this.http.delete<any>(`${this.baseUrl}/productos/${id}`);
  }

  // Clientes
  getClientes(): Observable<any[]> {
    return this.http.get<any[]>(`${this.baseUrl}/clientes`);
  }

  getCliente(id: number): Observable<any> {
    return this.http.get<any>(`${this.baseUrl}/clientes/${id}`);
  }

  createCliente(data: any): Observable<any> {
    return this.http.post<any>(`${this.baseUrl}/clientes`, data);
  }

  updateCliente(id: number, data: any): Observable<any> {
    return this.http.put<any>(`${this.baseUrl}/clientes/${id}`, data);
  }

  deleteCliente(id: number): Observable<any> {
    return this.http.delete<any>(`${this.baseUrl}/clientes/${id}`);
  }

  // Proveedores
  getProveedores(): Observable<any[]> {
    return this.http.get<any[]>(`${this.baseUrl}/proveedores`);
  }

  getProveedor(id: number): Observable<any> {
    return this.http.get<any>(`${this.baseUrl}/proveedores/${id}`);
  }

  createProveedor(data: any): Observable<any> {
    return this.http.post<any>(`${this.baseUrl}/proveedores`, data);
  }

  updateProveedor(id: number, data: any): Observable<any> {
    return this.http.put<any>(`${this.baseUrl}/proveedores/${id}`, data);
  }

  deleteProveedor(id: number): Observable<any> {
    return this.http.delete<any>(`${this.baseUrl}/proveedores/${id}`);
  }

  // Ventas
  getVentas(): Observable<any[]> {
    return this.http.get<any[]>(`${this.baseUrl}/ventas`);
  }

  getVenta(id: number): Observable<any> {
    return this.http.get<any>(`${this.baseUrl}/ventas/${id}`);
  }

  createVenta(data: any): Observable<any> {
    return this.http.post<any>(`${this.baseUrl}/ventas`, data);
  }

  updateVenta(id: number, data: any): Observable<any> {
    return this.http.put<any>(`${this.baseUrl}/ventas/${id}`, data);
  }

  deleteVenta(id: number): Observable<any> {
    return this.http.delete<any>(`${this.baseUrl}/ventas/${id}`);
  }

  // Movimientos de Inventario
  getMovimientos(): Observable<any[]> {
    return this.http.get<any[]>(`${this.baseUrl}/movimientos`);
  }

  getMovimiento(id: number): Observable<any> {
    return this.http.get<any>(`${this.baseUrl}/movimientos/${id}`);
  }

  createMovimiento(data: any): Observable<any> {
    return this.http.post<any>(`${this.baseUrl}/movimientos`, data);
  }

  updateMovimiento(id: number, data: any): Observable<any> {
    return this.http.put<any>(`${this.baseUrl}/movimientos/${id}`, data);
  }

  deleteMovimiento(id: number): Observable<any> {
    return this.http.delete<any>(`${this.baseUrl}/movimientos/${id}`);
  }
}
