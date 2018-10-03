/**
 * SMARTBUS API
 * No description provided (generated by Swagger Codegen https://github.com/swagger-api/swagger-codegen)
 *
 * OpenAPI spec version: 1.0.0
 * 
 *
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen.git
 * Do not edit the class manually.
 */


#include "ModelDevModel.h"

#include "SWGHelpers.h"

#include <QJsonDocument>
#include <QJsonArray>
#include <QObject>
#include <QDebug>

namespace api {

ModelDevModel::ModelDevModel(QString* json) {
    init();
    this->fromJson(*json);
}

ModelDevModel::ModelDevModel() {
    init();
}

ModelDevModel::~ModelDevModel() {
    this->cleanup();
}

void
ModelDevModel::init() {
    id = 0L;
    name = new QString("");
    model = new QString("");
    features = new QList<QString*>();
    created_at = NULL;
    updated_at = NULL;
}

void
ModelDevModel::cleanup() {

    if(name != nullptr) {
        delete name;
    }
    if(model != nullptr) {
        delete model;
    }
    if(features != nullptr) {
        QList<QString*>* arr = features;
        foreach(QString* o, *arr) {
            delete o;
        }
        delete features;
    }
    if(created_at != nullptr) {
        delete created_at;
    }
    if(updated_at != nullptr) {
        delete updated_at;
    }
}

ModelDevModel*
ModelDevModel::fromJson(QString &json) {
    QByteArray array (json.toStdString().c_str());
    QJsonDocument doc = QJsonDocument::fromJson(array);
    QJsonObject jsonObject = doc.object();
    this->fromJsonObject(jsonObject);
    return this;
}

void
ModelDevModel::fromJsonObject(QJsonObject &pJson) {
    ::api::setValue(&id, pJson["id"], "qint64", "");
    ::api::setValue(&name, pJson["name"], "QString", "QString");
    ::api::setValue(&model, pJson["model"], "QString", "QString");
    ::api::setValue(&features, pJson["features"], "QList", "QString");
    ::api::setValue(&created_at, pJson["created_at"], "QDateTime", "QDateTime");
    ::api::setValue(&updated_at, pJson["updated_at"], "QDateTime", "QDateTime");
}

QString
ModelDevModel::asJson ()
{
    QJsonObject* obj = this->asJsonObject();
    
    QJsonDocument doc(*obj);
    QByteArray bytes = doc.toJson();
    return QString(bytes);
}

QJsonObject*
ModelDevModel::asJsonObject() {
    QJsonObject* obj = new QJsonObject();
    obj->insert("id", QJsonValue(id));
    toJsonValue(QString("name"), name, obj, QString("QString"));
    toJsonValue(QString("model"), model, obj, QString("QString"));
    QJsonArray featuresJsonArray;
    toJsonArray((QList<void*>*)features, &featuresJsonArray, "features", "QString");
    obj->insert("features", featuresJsonArray);
    toJsonValue(QString("created_at"), created_at, obj, QString("QDateTime"));
    toJsonValue(QString("updated_at"), updated_at, obj, QString("QDateTime"));

    return obj;
}

qint64
ModelDevModel::getId() {
    return id;
}
void
ModelDevModel::setId(qint64 id) {
    this->id = id;
}

QString*
ModelDevModel::getName() {
    return name;
}
void
ModelDevModel::setName(QString* name) {
    this->name = name;
}

QString*
ModelDevModel::getModel() {
    return model;
}
void
ModelDevModel::setModel(QString* model) {
    this->model = model;
}

QList<QString*>*
ModelDevModel::getFeatures() {
    return features;
}
void
ModelDevModel::setFeatures(QList<QString*>* features) {
    this->features = features;
}

QDateTime*
ModelDevModel::getCreatedAt() {
    return created_at;
}
void
ModelDevModel::setCreatedAt(QDateTime* created_at) {
    this->created_at = created_at;
}

QDateTime*
ModelDevModel::getUpdatedAt() {
    return updated_at;
}
void
ModelDevModel::setUpdatedAt(QDateTime* updated_at) {
    this->updated_at = updated_at;
}


}
