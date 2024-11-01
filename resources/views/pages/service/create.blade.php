<x-main>
    <section id="basic-horizontal-layouts">
        <div class="row">
            <div class="col-md-10 offset-md-1 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Horizontal Form</h4>
                    </div>
                    <div class="card-body">
                        <form class="form form-horizontal" method="POST" action="{{ route('articles.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="first-name">First Name</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="first-name" class="form-control" name="fname" placeholder="First Name" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="email-id">Email</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="email" id="email-id" class="form-control" name="email-id" placeholder="Email" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="contact-info">Mobile</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="number" id="contact-info" class="form-control" name="contact" placeholder="Mobile" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="password">Password</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="password" id="password" class="form-control" name="password" placeholder="Password" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-9 offset-sm-3">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1" />
                                            <label class="custom-control-label" for="customCheck1">Remember me</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-9 offset-sm-3">
                                    <button type="subm" class="btn btn-primary mr-1">Submit</button>
                                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-main>