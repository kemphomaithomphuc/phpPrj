from flask import Flask, request, render_template_string

app = Flask(__name__)

@app.route('/login', methods=['GET'])
def login_form():
    return '''
    <form action="/login" method="post">
      <input type="text" name="who" placeholder="Email">
      <input type="password" name="pass" placeholder="Password">
      <input type="submit" value="Log In">
    </form>
    '''

@app.route('/login', methods=['POST'])
def login_submit():
    who = request.form.get('who')
    password = request.form.get('pass')

    # Example check (replace with real authentication)
    if who == 'umsi@umich.edu' and password == 'correctpassword':
        return 'Login successful'
    else:
        return 'Login failed', 401

if __name__ == '__main__':
    app.run(debug=True)
