<li class="nav-item">
    {{-- Search toggle button --}}
    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
        <i class="fas fa-search"></i>
    </a>

    {{-- Search bar --}}
    <div class="navbar-search-block">
        <form class="form-inline" action="{{ route('search') }}" method="GET">
            {{ csrf_field() }}

            <div class="input-group">

                {{-- Search type dropdown --}}
                <select class="form-control form-control-navbar" name="type">
                    <option value="users">Users</option>
                    <option value="employees">Employees</option>
                    <option value="attendances">Attendances</option>
                    <option value="leaves">Leaves</option>
                    <option value="payrolls">Payrolls</option>
                </select>

                {{-- Search input --}}
                <input class="form-control form-control-navbar" type="search"
                    id="search-input"
                    name="query"
                    placeholder="Search..."
                    aria-label="Search">

                {{-- Search buttons --}}
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

            </div>
        </form>
    </div>
</li>
