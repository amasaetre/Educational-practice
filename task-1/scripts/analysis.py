import pandas as pd
import numpy as np
import matplotlib.pyplot as plt
import seaborn as sns
from sklearn.linear_model import LinearRegression

# Загрузка данных
data = pd.read_csv('../data/economic_data.csv')

# Просмотр первых строк данных
print(data.head())

# Основная статистика
print(data.describe())

# Построение графиков
plt.figure(figsize=(12, 6))

# Гистограмма распределения цен
plt.subplot(1, 2, 1)
sns.histplot(data['price'], kde=True)
plt.title('Распределение цен')

# Корреляция между ценой и количеством продаж
plt.subplot(1, 2, 2)
sns.scatterplot(x='price', y='quantity_sold', data=data)
plt.title('Цены vs Количество проданных')

plt.tight_layout()
plt.savefig('../plots/price_quantity.png')
plt.show()

# Применение регрессии для анализа взаимосвязи
X = data[['price']]
y = data['quantity_sold']
model = LinearRegression()
model.fit(X, y)
print(f'Коэффициенты регрессии: {model.coef_}, Свободный член: {model.intercept_}')

# Прогнозирование
data['predicted_quantity_sold'] = model.predict(X)

# Сохранение обновленных данных
data.to_csv('../data/economic_data_with_predictions.csv', index=False)
