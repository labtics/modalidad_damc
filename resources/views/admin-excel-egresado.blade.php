              @php
                $i = 0
              @endphp
              <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Núm.</th>
                      <th>Matrícula</th>
                      <th>Licenciatura</th>
                      <th>Apellidos</th>
                      <th>Nombre</th>
                      <th>Sexo</th>
                      <th>Edad</th>
                      <th>Modalidad</th>
                      <th>Email</th>
                      <th>Telefono</th>
                      <th>Fecha</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($user as $egresado)
                    <tr>
                      <td>{{++$i}}</td>
                      <td>{{$egresado->matricula}}</td>
                      <td>{{$egresado->licenciatura}}</td>
                      <td>{{ucwords($egresado->apellidos)}}</td>
                      <td>{{ucwords($egresado->nombre)}}</td>
                      <td>{{ucwords($egresado->sexo)}}</td>
                      <td>{{$egresado->edad}}</td>
                      <td>{{$egresado->modalidad}}</td>
                      <td>{{$egresado->email}}</td>
                      <td>{{$egresado->telefono}}</td>
                      <td>{{$egresado->created_at}}</td>
                    </tr>
                  @endforeach
                  </tbody>
              </table>