import pandas as pd
import pickle as pkl
import sys
with open('C:/xampp/htdocs/avashXampp/housePricePredection/model.pkl','rb')as f:
    model=pkl.load(f)

loc=sys.argv[1]
tsqft=float(sys.argv[2])
bath=float(sys.argv[3])
balc=float(sys.argv[4])
bedroom=float(sys.argv[5])

input=pd.DataFrame([[loc,tsqft,bath,balc,bedroom]],columns=['location'	,'total_sqft','bath','balcony','bedroom'])
prediction=model.predict(input)
print(prediction[0])