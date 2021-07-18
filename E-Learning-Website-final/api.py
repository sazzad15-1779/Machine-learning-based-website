from flask import Flask, render_template, flash, redirect, url_for, session, request, logging
import pickle
import numpy as np
from flask_mysqldb import MySQL
from wtforms import Form, StringField, TextAreaField, PasswordField, validators
from passlib.hash import sha256_crypt
from functools import wraps
from flask_bcrypt import Bcrypt


app = Flask(__name__)
app.config['MYSQL_HOST'] = 'localhost'
app.config['MYSQL_USER'] = 'root'
app.config['MYSQL_PASSWORD'] = ''
app.config['MYSQL_DB'] = 'student'
app.config['MYSQL_CURSORCLASS'] = 'DictCursor'
# init MYSQL
bcrypt = Bcrypt(app)
mysql = MySQL(app)

def is_logged_in(f):
    @wraps(f)
    def wrap(*args, **kwargs):
        if 'logged_in' in session:
            return f(*args, **kwargs)
        else:
            flash('Unauthorized, Please login', 'danger')
            return redirect(url_for('login'))
    return wrap
    


@app.route('/')
def homepage():
    return render_template('homepage.php')
@app.route('/deeplearning',methods=['POST','GET'])
def deeplearning():
    return render_template('introduction_dl.php')

@app.route('/machinelearning',methods=['POST','GET'])
def machinelearning():
    return render_template('Introduction_ml.php')

@app.route('/python',methods=['POST','GET'])
def python():
    return render_template('Introduction_py.php')
@app.route('/robotics',methods=['POST','GET'])
def robotics():
    return render_template('introduction_robotic.php')

@app.route('/ai',methods=['POST','GET'])
def ai():
    return render_template('Introduction_ai.php')


@app.route('/logout')
@is_logged_in
def logout():
    session.clear()
    flash('You are now logged out', 'success')
    return redirect(url_for('login'))

class RegisterForm(Form):
    name = StringField('Name', [validators.Length(min=1, max=50)])
    username = StringField('Username', [validators.Length(min=4, max=25)])
    email = StringField('Email', [validators.Length(min=6, max=50)])
    password = PasswordField('Password', [
        validators.DataRequired(),
        validators.EqualTo('confirm', message='Passwords do not match')
    ])
    confirm = PasswordField('Confirm Password')



@app.route('/login',methods=['POST','GET'])
def login():
    if request.method == 'POST':
        # Get Form Fields
        username = request.form['username']
        password_candidate =request.form['password']

        # Create cursor
        cur = mysql.connection.cursor()

        # Get user by username
        result = cur.execute("SELECT * FROM users WHERE username = %s", [username])
        if result > 0:
            # Get stored hash
            data = cur.fetchone()
            password = data['password']
           
            # Compare Passwords
            if ((password_candidate == password)):
               

                session['logged_in'] = True
                session['username'] = username

                flash('You are now logged in', 'success')
                return redirect(url_for('homepage'))
            else:
                error = 'Invalid login'
                return render_template('login.php', error=error)
            # Close connection
            cur.close()
        else:
            error = 'Username not found'
            return render_template('login.php', error=error)
    return render_template('login.php')


@app.route('/signUp',methods=['POST','GET'])
def signUp():
    form = RegisterForm(request.form)
    if request.method == 'POST' and form.validate():
        name = form.name.data
        email = form.email.data
        username = form.username.data
        password = form.password.data

        # Create cursor
        cur = mysql.connection.cursor()

        # Execute query
        cur.execute("INSERT INTO users(name, email, username, password) VALUES(%s, %s, %s, %s)", (name, email, username, password))

        # Commit to DB
        mysql.connection.commit()

        # Close connection
        cur.close()
        
        flash('You are now registered and can log in', 'success')

        return redirect(url_for('login'))
    return render_template('register.html', form=form)


@app.route('/project',methods=['POST','GET'])
def project():
    return render_template('project.php')


## forest fire prediction

model=pickle.load(open('model.pkl','rb'))
@app.route('/forest_fire',methods=['POST','GET'])
def forest_fire(): 
    return render_template('forest_fire.php')

@app.route('/predict',methods=['POST','GET'])
def predict():
    int_features=[int(x) for x in request.form.values()] #list
    final=[np.array(int_features)]  # numpy array
    
    prediction=model.predict_proba(final)
    output='{0:.{1}f}'.format(prediction[0][1], 2)

    if output>str(0.5):
        return render_template('forest_fire.php',pred='Your Forest is in Danger. Probability of fire occuring is {}'.format(output),b="")
    else:
        return render_template('forest_fire.php',pred='Your Forest is safe. Probability of fire occuring is {}'.format(output),b="")

@app.route('/code_description',methods=['POST','GET'])
def code_description(): 
    return render_template('code_description.html')

#fake news prediction

loaded_model = pickle.load(open('model1.pkl', 'rb'))

@app.route('/Fake_news',methods=['POST','GET'])
def Fake_news(): 
    return render_template('fake_news.html')    

@app.route('/predict1',methods=['POST','GET'])
def predict1(): 
    from sklearn.model_selection import train_test_split
    from sklearn.feature_extraction.text import TfidfVectorizer
    from sklearn.linear_model import PassiveAggressiveClassifier
    from sklearn.metrics import accuracy_score, confusion_matrix
    import pandas as pd

    dataframe = pd.read_csv('news.csv')

    x = dataframe['text']
    y = dataframe['label']

    x_train,x_test,y_train,y_test = train_test_split(x,y,test_size=0.2,random_state=0)
    y_train

    tfvect = TfidfVectorizer(stop_words='english',max_df=0.7)
    tfid_x_train = tfvect.fit_transform(x_train)
    tfid_x_test = tfvect.transform(x_test)

    classifier = PassiveAggressiveClassifier(max_iter=50)
    classifier.fit(tfid_x_train,y_train)
    if request.method == 'POST':
        m=request.form['message']
        input_data = [m]
        vectorized_input_data = tfvect.transform(input_data)
        prediction = classifier.predict(vectorized_input_data)
        print(prediction)
        return render_template('fake_news.html', pr=prediction)
    else:
        return render_template('fake_news.html', pr="Something went wrong")

#### Ai #######

@app.route('/Learning_path_dl',methods=['POST','GET'])
def  Learning_path_dl(): 
    return render_template('Learning_path_dl.html')

@app.route('/single_neuron',methods=['POST','GET'])
def  single_neuron(): 
    return render_template('single_neuron.html')
@app.route('/Deep_neural_networks',methods=['POST','GET'])
def  Deep_neural_networks(): 
    return render_template('Deep_neural_networks.html')
@app.route('/Stochastic_gradient_descent',methods=['POST','GET'])
def  Stochastic_gradient_descent(): 
    return render_template('Stochastic_gradient_descent.html')
@app.route('/overfitting_underfitting',methods=['POST','GET'])
def  overfitting_underfitting(): 
    return render_template('overfitting_underfitting.html')
@app.route('/Dropout',methods=['POST','GET'])
def  Dropout(): 
    return render_template('Dropout.html')
@app.route('/batch_normalization',methods=['POST','GET'])
def  batch_normalization(): 
    return render_template('batch_normalization.html')
@app.route('/Binary_classification',methods=['POST','GET'])
def  Binary_classification(): 
    return render_template('Binary_classification.html')

 
#########

@app.route('/quiz',methods=['POST','GET'])
def  quiz(): 
    return render_template('quize.html')




if __name__ == '__main__':
    app.secret_key='secret123'
    app.run(debug=True)
