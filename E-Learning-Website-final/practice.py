from flask import Flask, render_template, flash, redirect, url_for, session, request, logging

app = Flask(__name__)

@app.route('/')
def practice():
    return render_template('practice.html')
if __name__ == '__main__':
    app.secret_key='secret123'
    app.run(debug=True)